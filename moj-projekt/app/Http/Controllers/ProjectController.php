<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        $users = User::all();
        return view('projects.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $projectData = $request->all();
        $projectData['owner_id'] = $request->user()->id;

        $project = Project::create($projectData);

        // Automatski dodaj voditelja kao člana
        $members = [$request->user()->id];
        
        // Dodaj odabrane članove (ako postoje)
        if ($request->has('members') && is_array($request->members)) {
            $members = array_unique(array_merge($members, $request->members));
        }
        
        $project->members()->attach($members);

        return redirect()->route('projects.index')->with('success', 'Projekt je uspješno kreiran');
    }

    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $users = User::all();
        return view('projects.edit', compact('project', 'users'));
    }

    // Voditelj može ažurirati sve, članovi samo completed_tasks
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        if ($request->user()->is($project->owner)) {
            $project->update($request->all());
            
            // Ažuriraj članove projekta
            $members = [$project->owner_id]; // Voditelj je uvijek član
            
            // Dodaj odabrane članove (ako postoje)
            if ($request->has('members') && is_array($request->members)) {
                $members = array_unique(array_merge($members, $request->members));
            }
            
            $project->members()->sync($members);
        } else {
            $project->update(['completed_tasks' => $request->completed_tasks]);
        }

        return redirect()->route('projects.index')->with('success', 'Projekt je uspješno ažuriran');
    }

    // Voditelj može obrisati projekt, članovi ne mogu
    public function destroy(Request $request, Project $project)
    {
        if ($request->user()->is($project->owner)) {
            $project->delete();
        } else {
            return redirect()->route('projects.index')->with('error', 'Nemate dozvolu za brisanje ovog projekta');
        }
        return redirect()->route('projects.index')->with('success', 'Projekt je uspješno obrisan');
    }

    public function addMember(Project $project, User $user)
    {
        $project->members()->attach($user);
        return redirect()->route('projects.show', $project)->with('success', 'Korisnik je uspješno dodan u projekt');
    }

    public function removeMember(Project $project, User $user)
    {
        $project->members()->detach($user);
        return redirect()->route('projects.show', $project)->with('success', 'Korisnik je uspješno uklonjen iz projekta');
    }
}
