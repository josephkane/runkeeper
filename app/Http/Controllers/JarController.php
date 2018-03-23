<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Run as Run;
use App\Jar as Jar;

class JarController extends Controller
{
	public function __construct(Run $run, Jar $jar)
	{
		$this->run = $run;
		$this->jar = $jar;
	}

	public function index(Request $request, $run_id, Run $run, Jar $jar)
	{
		$data = [];

		$selected_run = $this->run->find($run_id);
		$jars = $selected_run->jars()->get();
		$data["jars"] = $jars;
		$data["run_id"] = $run_id;
		return view("jar/index", $data);
	}

	public function show($jar_id) 
	{
		$data = [];
		$data["modify"] = 1;
		$data["jar_id"] = $jar_id;

		$run_data = $this->jar->find($jar_id);
		
		$data["run_id"] = $run_data->run_id;
		$data["proof_start"] = $run_data->proof_start;
		$data["column_temp_start"] = $run_data->column_temp_start;
		$data["proof_end"] = $run_data->proof_end;
		$data["column_temp_end"] = $run_data->column_temp_end;
		$data["volume"] = $run_data->volume;
		
		return view("jar/form", $data);
	}

	public function newJar(Request $request, $run_id, Jar $jar)
	{
		$data = [];
		$selected_run = $this->run->find($run_id);
		$current_run_count = $selected_run->jars()->count();

		$data["time_started"] = strftime("%H:%M:%S", time());
		$data["run_id"] = $run_id;
		$data["number"] = $current_run_count + 1;
		$data["proof_start"] = $request->input("proof_start");
		$data["column_temp_start"] = $request->input("column_temp_start");
		$data["proof_end"] = $request->input("proof_end");
		$data["column_temp_end"] = $request->input("column_temp_end");
		$data["volume"] = $request->input("volume");
		$data["favorite"] = 0;

		if ($request->isMethod("post")) 
		{
			$this->validate(
				$request,
				[
					"proof_start" => "required|min:2",
					"column_temp_start" => "required|min:3",
				]
			);

			$jar->insert($data);

			return redirect("jars/$run_id");
		}

		$data["modify"] = 0;
		return view("jar/form", $data);
	}

	public function modify(Request $request, $jar_id, Jar $jar)
	{
		$data = [];

		if ($request->isMethod("post")) 
		{
			$this->validate(
				$request,
				[
					"proof_start" => "required|min:2",
					"column_temp_start" => "required|min:3",
				]
			);

			$jar_data = $this->jar->find($jar_id);

			$jar_data->proof_start = $request->input("proof_start");
			$jar_data->column_temp_start = $request->input("column_temp_start");
			$jar_data->proof_end = $request->input("proof_end");
			$jar_data->column_temp_end = $request->input("column_temp_end");
			$jar_data->volume = $request->input("volume");
			$jar_data->favorite = 0;

			$jar_data->save();

			return redirect("jars/$jar_data->run_id");
		}

		$data["modify"] = 1;
		return view("jar/form", $data);
	}

	public function toggleFavorite(Request $request, Jar $jar)
	{
		$data = [];
		$toggle = ["0" => "1", "1" => "0"];
		$jar_id = $request->input("jar_id");
		$selected_jar = $this->jar->find($jar_id);
		$fav_value = $request->input("favorite");
		$new_fav_value = $toggle[$fav_value];

		$selected_jar->favorite = $new_fav_value;

		if ($selected_jar->save()) {
			return response()->view("jar/favToggle", ["jar_id" => $jar_id, "favorite" => $new_fav_value, "jar_number" => $selected_jar->number])->setStatusCode(200);
		} else { 
			return response("toggle error", 500);
		}

	}
}
