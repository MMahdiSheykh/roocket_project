<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use function PHPUnit\Framework\isFalse;
use function PHPUnit\Framework\isNull;
use function PHPUnit\Framework\isTrue;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:show-comment')->only(['index', 'unapproved']);
        $this->middleware('can:approve-comment')->only('update');
        $this->middleware('can:delete-comment')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::paginate(20);

        // search box
        if ($result = request('search')) {
            $comments = Comment::query();

            $comments->where('comment', 'LIKE', "%{$result}%")
                ->orWhere('user_id', $result)
                ->orWhere('id', $result);

            $comments = $comments->paginate(20);
        }

        // show approved or unapproved
        if (request('approved')) {
            $comments = Comment::query();

            if (request('approved') == 'approved') {
                $comments->where('approved', '=', 1);
            } elseif (request('approved') == 'unapproved') {
                $comments->where('approved', '=', 0);
            }
            $comments = $comments->paginate(20);
        }

        return view('admin.comments.all', compact('comments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        if ($comment->approved == 0) {
            $comment->update(['approved' => 1]);
        } else {
            $comment->update(['approved' => 0]);
        }

        Alert::success('Well done!', 'The comment has been approved successfully');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        Alert::success('Well done!', 'The comment has been deleted successfully');
        return back();
    }

    public function unapproved()
    {
        $comments = Comment::where('approved', 0)->paginate(20);
        return view('admin.comment.unapproved', compact('comments'));
    }
}
