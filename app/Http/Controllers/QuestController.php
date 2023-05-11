<?php

namespace App\Http\Controllers;

use App\Models\Quest;
use App\Models\Character;
use Illuminate\Http\Request;
use App\Http\Requests\StoreQuest;
use Illuminate\Support\Facades\Auth;

class QuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quests = Quest::all();

        return view('quests.index', compact('quests'));
    }

    public function accept(Request $request)
    {
        $user = Auth::user();
        $character = Character::findOrFail(session('selected_character_id'));
        $quest = Quest::findOrFail($request->input('quest_id'));

        if ($character->level < $quest->min_level) {
            return redirect()->back()->with('error', 'You do not meet the level requirement for this quest.');
        }

        if (!$character->canAcceptQuest($quest)) {
            return redirect()->back()->with('error', 'You have already accepted this quest.');
        }

        $character->quests()->attach($quest, ['status' => 'in_progress']);
        $character->save();

        return redirect()->back()->with('success', 'Quest accepted successfully!');
    }


    public function start(Request $request)
    {
        $quest = Quest::findOrFail($request->input('quest_id'));
        $character = Character::findOrFail($request->input('character_id'));

        if ($character->level >= $quest->required_level) {
            $character->quests()->attach($quest, ['status' => 'active']);

            return redirect()->route('quests.index')->with('success', 'Quest started!');
        }

        return redirect()->route('quests.index')->with('error', 'Character level too low to start quest.');
    }

    public function complete(Request $request)
    {
        $quest = Quest::findOrFail($request->input('quest_id'));
        $character = Character::findOrFail($request->input('character_id'));

        $character->quests()->updateExistingPivot($quest->id, ['status' => 'completed']);

        $character->gold += $quest->reward_gold;
        $character->exp += $quest->reward_exp;
        $character->save();

        return redirect()->route('quests.show', $quest)->with('success', 'Quest completed!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.quests.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuest $request)
    {
        $validated = $request->validated();
        $quest =  Quest::create($validated);

        $quest->save();
        $request->session()->flash('status', 'Quest created!');
        return redirect()->route('admin.quests', ['quest' => $quest->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quest  $quest
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $quest = Quest::findOrFail($id);
        return view('admin.quests.show', compact('quest'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Quest  $quest
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quest = Quest::findOrFail($id);
        return view('admin.quests.edit', [
            'quest' => $quest,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Quest  $quest
     * @return \Illuminate\Http\Response
     */
    public function update(StoreQuest $request, $id)
    {
        $quest = Quest::findOrFail($id);
        $validated = $request->validated();
        $quest ->fill($validated);

        $quest->save();
        $request->session()->flash('status', 'Quest Updated');
        return redirect()->route('quest.edit', ['quest' => $quest->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Quest  $quest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $quest = Quest::findOrFail($id);
        
        $quest->delete();

        $request->session()->flash('status', 'Quest deleted!');

        return redirect()->route('admin.quests');
    }
}
