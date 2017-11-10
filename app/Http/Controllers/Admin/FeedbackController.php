<?php

namespace App\Http\Controllers\Admin;

use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeedbackController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getFeedbackStatistics()
    {
        $smile_count = Feedback::all()->where('type','=','smile')->count();
        $frown_count = Feedback::all()->where('type','=','frown')->count();
        $heart_count = Feedback::all()->where('type','=','heart')->count();
        return view('components.feedbackCounters', ['smile_count' => $smile_count, 'frown_count' => $frown_count, 'heart_count' => $heart_count]);
    }

    public function getInboxMessages()
    {
        $messages = Feedback::all()->where('state', '=', 'inbox')->where('message','!=','')->sortByDesc('id');
        return view('partials.feedbackCards', ['messages' => $messages]);
    }

    public function getStarMessages()
    {
        $messages = Feedback::all()->where('state', '=', 'star')->where('message','!=','')->sortByDesc('id');
        return view('partials.feedbackCards', ['messages' => $messages]);
    }

    public function getLaterMessages()
    {
        $messages = Feedback::all()->where('state', '=', 'later')->where('message','!=','')->sortByDesc('id');
        return view('partials.feedbackCards', ['messages' => $messages]);
    }

    public function getArchiveMessages()
    {
        $messages = Feedback::all()->where('state', '=', 'archive')->where('message','!=','')->sortByDesc('id');
        return view('partials.feedbackCards', ['messages' => $messages]);
    }

    public function changeState($id, $state)
    {
        $states = array('inbox', 'star', 'later', 'archive');
        if(!in_array($state,$states)){
            abort(403);
        }
        $message = Feedback::find($id);
        $message->state = $state;
        $message->save();
    }

    public function destroy($id)
    {
        $message = Feedback::find($id);
        $message->message = '';
        $message->save();
    }
}
