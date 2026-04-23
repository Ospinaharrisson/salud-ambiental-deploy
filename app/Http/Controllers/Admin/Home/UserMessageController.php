<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Shared\Home\UserMessage;

class UserMessageController extends Controller
{
    public function messageHomeView()
    {
        return view('Admin.Dashboard.Home.user.message-home');
    }


    public function showMessage($id)
    {
        $message = UserMessage::findOrFail($id);
        return view('Admin.Dashboard.Home.user.message-show', compact('message'));
    }
    
    public function destroyMessage($id)
    {
        $message = UserMessage::findOrFail($id);
        $message->delete();
        return redirect()->route('admin.home.message')->with('mensaje', 'Mensaje eliminado exitosamente.');
    }
}
