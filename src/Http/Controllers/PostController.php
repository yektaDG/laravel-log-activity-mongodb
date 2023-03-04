<?php

namespace Yektadg\LaravelLogActivityMongodb\Http\Controllers;

use Yektadg\LaravelLogActivityMongodb\Models\Post;


// --------------------------------------------------------------

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return view('blogpackage::posts.index', compact('posts'));
    }

    public function show()
    {
        $post = Post::findOrFail(request('post'));

        return view('blogpackage::posts.show', compact('post'));
    }

    public function store()
    {
        // Let's assume we need to be authenticated
        // to create a new post
        if (! auth()->check()) {
            abort (403, 'Only authenticated users can create new posts.');
        }

        request()->validate([
            'title' => 'required',
            'body'  => 'required',
        ]);

        // Assume the authenticated user is the post's author
        $author = auth()->user();

        $post = $author->posts()->create([
            'title'     => request('title'),
            'body'      => request('body'),
        ]);

        return redirect(route('posts.show', $post));
    }
}

//---------------------------------------------------------------
// use App\Models\Log;
// use App\Models\User;
// use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;
// use App\Models\Ticket;
// use App\Models\TicketComment;
// use Carbon\Carbon;
// use MongoDB\BSON\UTCDateTime;


// class LogController extends Controller
// {
//     /**
//      * Display a listing of the resource.
//      *
//      * @return \Illuminate\Http\Response
//      */
//     public function index(Request $request)
//     {

//         $logs = Log::where('created_at' ,'!=', null);
//         if ($request->user_id)
//         {
//             $logs= $logs->where('user_id' , $request->user_id);
//         }
//         if($request->model_name and $request->model_name != 'All') {
//             $logs->where('logable_type','App\\Models\\'.$request->model_name);
//         }

//         if($request->agent_id and $request->agent_name != 'All') {
//             $logs->where('logable_id', $request->agent_id);
//         }

//         if($request->action and $request->action != 'all') {
//             $logs->where('action', $request->action);
//         }

//         if ($request->from)
//         {
//             $from = Carbon::parse($request->from);
//             $temp = new UTCDateTime($from);
//             $logs = $logs->where('created_at', '>' , $temp);
//         }

//         if ($request->to)
//         {
//             $to = Carbon::parse($request->to);
//             $temp = new UTCDateTime($to);
//             $logs = $logs->where('created_at', '<' , $temp);
//         }

//         $logs = $logs->paginate(15);
//         foreach($logs as $log)
//             {
//                 if ( $log->data){
//                     $log->data = json_decode($log->data, true);
//                 }
//             }
//         $models = Log::select('logable_type')->distinct()->get();
//         return view('admin.page.log.index',
//             [
//                 'logs' => $logs,
//                 'models' => $models,
//                 'model_name' => $request->model_name,
//             ]); 
        
        
//     }

   

//     public function getUsers(Request $request)
//     {
        
//         $data = [];
//         $search = $request->q;

//         if(! $request->has('q')){
//             $data = User::orderby('created_at','asc')->select('id','name' , 'email')->limit(10)->get();
//         }
//         else{
//             $data = User::orderby('created_at','asc')->select('id','name', 'email')
//             ->where('name', 'like', '%' .$search . '%')
//             ->orWhere('phone', 'like', '%' .$search . '%')
//             ->orWhere('email', 'like', '%' .$search . '%')
//             ->limit(10)->get();
//         }
//         foreach($data as $d){
//             $d['name_email']= $d->name. ' | ' . $d -> email;
//         }
//         return response()->json($data);
//     }


//     public function getModels(Request $request)
//     {
        
//         $data = [];
//         $search = $request->q;
//         if(! $request->q){
//             $data = Log::select('logable_type')->distinct()->limit(10)->get();
//         }
        
//         else{

//             $data = Log::select('logable_type',)
//             ->where('logable_type', 'like', '%' .$search . '%')
//             ->distinct()
//             ->limit(10)->get();
//         }
//         foreach($data as $d){
//             $temp =  explode("\\",json_decode($d)[0]);
//             $d['name']=end($temp);
//         }

//         return response()->json($data);
//     }



//     public function getTickets(Request $request)
//     {
//         $data = [];
//         $search = $request->q;
//         if(!$request->q){
//             $data = Ticket::select('id' , 'title', 'description')
//             ->limit(10)->get();
//         }
        
//         else{
//             $data = Ticket::select('id' , 'title','description')
//             ->where('title', 'like', '%' .$search . '%')
//             ->orWhere('description', 'like', '%' .$search . '%')
//             ->distinct()
//             ->limit(10)->get();
//         }
//         // $array = [
//         //     "id" => "1",
//         //     "title" => "All Tickets",
//         //     "description" => ""
//         // ];
//         // $data->prepend($array);
//         return response()->json($data);
//     }


//     public function getTicketComments(Request $request)
//     {
//         $data = [];
//         $search = $request->q;
//         if(!$request->q){
//             $data = TicketComment::select('id' , 'description')
//             ->limit(10)->get();
//         }
        
//         else{
//             $data = TicketComment::select('id' ,'description')
//             ->where('description', 'like', '%' .$search . '%')
//             ->distinct()
//             ->limit(10)->get();
//         }

//         foreach($data as $d){
//             $d['description']=strip_tags($d->description);
//         }

//         // $array = [
//         //     "id" => "2",
//         //     "description" => "All Comments"
//         // ];
//         // $data->prepend($array);

//         return response()->json($data);
//     }

    


//     /**
//      * Show the form for creating a new resource.
//      *
//      * @return \Illuminate\Http\Response
//      */
//     public function create()
//     {
//         //
//     }

//     /**
//      * Store a newly created resource in storage.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @return \Illuminate\Http\Response
//      */
//     public function store(Request $request)
//     {

//     }

//     /**
//      * Display the specified resource.
//      *
//      * @param  \App\Models\Log  $Log
//      * @return \Illuminate\Http\Response
//      */
//     public function show(Log $Log)
//     {
//         //
//     }

//     /**
//      * Show the form for editing the specified resource.
//      *
//      * @param  \App\Models\Log  $Log
//      * @return \Illuminate\Http\Response
//      */
//     public function edit(Log $Log)
//     {
//         //
//     }

//     /**
//      * Update the specified resource in storage.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @param  \App\Models\Log  $Log
//      * @return \Illuminate\Http\Response
//      */
//     public function update(Request $request, Log $Log)
//     {
//         //
//     }

//     /**
//      * Remove the specified resource from storage.
//      *
//      * @param  \App\Models\Log  $Log
//      * @return \Illuminate\Http\Response
//      */
//     public function destroy(Log $Log)
//     {
//         //
//     }
// }
