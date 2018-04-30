<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Log;
class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create_query()
    {
        return view('admin.query-builder');
    }
    public function show($id)
    {
        $row = DB::table('sql_queries')->find($id);
        $query = unserialize($row->query);
        return view('components.query-view', compact('row','query'));
    }

    public function store(Request $request)
    {
        $name = $request->input('name');
        $description = $request->input('description');

        $columns = [];
        $number_of_columns = (int)$request->input('number_of_columns');
        for ($i=1; $i<=$number_of_columns; $i++){
            $column = [
                'id' => $request->input('column_id_'.$i),
                'name' => $request->input('column_name_'.$i)
            ];
            array_push($columns, $column);
        }

        $parameters = [];
        $number_of_parameters = (int)$request->input('number_of_parameters');
        for ($i=1; $i<=$number_of_parameters; $i++){
            $parameter = '';
            if($request->input('p_type_'.$i) == 'textbox'){
                $parameter = [
                    'id' => $request->input('p_id_'.$i),
                    'name' => $request->input('p_name_'.$i),
                    'type' => $request->input('p_type_'.$i),
                    'query' => null,
                    'column' => null
                ];
            }elseif ($request->input('p_type_'.$i) == 'dropdown'){
                $parameter = [
                    'id' => $request->input('p_id_'.$i),
                    'name' => $request->input('p_name_'.$i),
                    'type' => $request->input('p_type_'.$i),
                    'query' => $request->input('p_query_'.$i),
                    'column' => $request->input('p_query_column_'.$i)
                ];
            }

            array_push($parameters, $parameter);
        }

        $query = [
            'query' => $request->input('query'),
            'columns' => $columns,
            'parameters' => $parameters
        ];

        DB::table('sql_queries')
            ->insert([
                'name' => $name,
                'description' => $description,
                'query' => serialize($query),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

        Session::flash('message', 'پرس و جوی شما با موفقیت در سامانه ثبت شد.');
        Session::flash('message_color', 'green');

        return redirect('admin/reports');
    }

    public function execute(Request $request, $id)
    {
        Log::debug("Execution started.");
        try {
            $row = DB::table('sql_queries')->find($id);
            $query = unserialize($row->query);
            $query_statement = $query['query'];
            foreach ($query['parameters'] as $parameter) {
                $search = '${' . $parameter['id'] . '}';
                $replace = '"' . $request->input($parameter['id']) . '"';
                $query_statement = str_replace($search, $replace, $query_statement);
            }
            $results = DB::select($query_statement);
            $columns = $query['columns'];
            return view('components.query-result', compact('results', 'columns'));
        }
        catch(\Illuminate\Database\QueryException $ex){
            Log::debug("Error in query string:\n$query_statement");
        }
    }
    public function edit($id)
    {
        $row = DB::table('sql_queries')->find($id);
        $query = unserialize($row->query);
        return view('components.query-edit',compact('row','query'));
    }
    public function update(Request $request, $id)
    {
        $name = $request->input('name');
        $description = $request->input('description');

        $columns = [];
        $number_of_columns = (int)$request->input('number_of_columns');
        for ($i=1; $i<=$number_of_columns; $i++){
            $column = [
                'id' => $request->input('column_id_'.$i),
                'name' => $request->input('column_name_'.$i)
            ];
            array_push($columns, $column);
        }

        $parameters = [];
        $number_of_parameters = (int)$request->input('number_of_parameters');
        for ($i=1; $i<=$number_of_parameters; $i++){
            $parameter = '';
            if($request->input('p_type_'.$i) == 'textbox'){
                $parameter = [
                    'id' => $request->input('p_id_'.$i),
                    'name' => $request->input('p_name_'.$i),
                    'type' => $request->input('p_type_'.$i),
                    'query' => null,
                    'column' => null
                ];
            }elseif ($request->input('p_type_'.$i) == 'dropdown'){
                $parameter = [
                    'id' => $request->input('p_id_'.$i),
                    'name' => $request->input('p_name_'.$i),
                    'type' => $request->input('p_type_'.$i),
                    'query' => $request->input('p_query_'.$i),
                    'column' => $request->input('p_query_column_'.$i)
                ];
            }

            array_push($parameters, $parameter);
        }

        $query = [
            'query' => $request->input('query'),
            'columns' => $columns,
            'parameters' => $parameters
        ];

        $query_row = DB::table('sql_queries')->find($id);
        $query_name = $query_row->name;

        DB::table('sql_queries')
            ->where('id',$id)
            ->update([
                'name' => $name,
                'description' => $description,
                'query' => serialize($query),
                'updated_at' => Carbon::now()
            ]);

        Session::flash('message', 'پرس و جوی "' . $query_name . '" با موفقیت به روز رسانی شد.');
        Session::flash('message_color', 'teal');

        return redirect('admin/reports');
    }
    public function destroy($id)
    {
        $query = DB::table('sql_queries')->find($id);
        $query_name = $query->name;
        DB::table('sql_queries')->where('id',$id)->delete();

        Session::flash('message', 'پرس و جوی "' . $query_name . '" با موفقیت از سامانه حذف شد.');
        Session::flash('message_color', 'orange');

        return redirect('admin/reports');
    }
}
