<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use App\Models\ChirpLike;
use App\Models\ChirpShare;
use App\Models\ChirpComment;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class ChirpInteractionController extends Controller
{
    /**
     * Toggle like para un chirp
     */
    public function toggleLike(Chirp $chirp): RedirectResponse
    {
        $user = auth()->user();
        
        $existingLike = ChirpLike::where('user_id', $user->id)
                                 ->where('chirp_id', $chirp->id)
                                 ->first();
        
        if ($existingLike) {
            // Si ya le dio like, quitarlo
            $existingLike->delete();
        } else {
            // Si no le dio like, agregarlo
            ChirpLike::create([
                'user_id' => $user->id,
                'chirp_id' => $chirp->id,
            ]);
        }
        
        return back();
    }
    
    /**
     * Toggle share para un chirp
     */
    public function toggleShare(Chirp $chirp): RedirectResponse
    {
        $user = auth()->user();
        
        $existingShare = ChirpShare::where('user_id', $user->id)
                                   ->where('chirp_id', $chirp->id)
                                   ->first();
        
        if ($existingShare) {
            // Si ya lo compartió, quitarlo
            $existingShare->delete();
        } else {
            // Si no lo compartió, agregarlo
            ChirpShare::create([
                'user_id' => $user->id,
                'chirp_id' => $chirp->id,
            ]);
        }
        
        return back();
    }
    
    /**
     * Agregar comentario a un chirp
     */
    public function addComment(Request $request, Chirp $chirp): RedirectResponse
    {
        $request->validate([
            'comment' => 'required|string|max:280',
        ]);
        
        ChirpComment::create([
            'user_id' => auth()->id(),
            'chirp_id' => $chirp->id,
            'comment' => $request->comment,
        ]);
        
        return back()->with('success', 'Comment added successfully!');
    }
    
    /**
     * Eliminar comentario
     */
    public function deleteComment(ChirpComment $comment): RedirectResponse
    {
        // Solo el autor del comentario puede eliminarlo
        if ($comment->user_id !== auth()->id()) {
            abort(403);
        }
        
        $comment->delete();
        
        return back()->with('success', 'Comment deleted successfully!');
    }
}
