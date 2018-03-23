<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Run as Run;
use App\User as User;

class RunController extends Controller
{
	public function __construct(Run $run)
	{
		$this->run = $run;
	}

	public function index(User $user)
	{
		$data = [];
		$data["user_id"] = Auth::id();
		$user = $user->find($data["user_id"]);
		$user_runs = $user->runs()->get();

		$data["runs"] = $user_runs;
		return view("run/index", $data);
	}

	public function show($run_id) 
	{
		$data = [];
		$data["run_id"] = $run_id;
		$data["modify"] = 1;
		$run_data = $this->run->find($run_id);
		$data["name"] = $run_data->name;
		$data["description"] = $run_data->description;
		$data["grain_bill"] = $run_data->grain_bill;
		$data["volume"] = $run_data->volume;
		$data["abv"] = $run_data->abv;
		$data["notes"] = $run_data->notes;
		$data["date"] = $run_data->date;
		return view("run/form", $data);
	}

	public function newRun(Request $request, Run $run)
	{
		$data = [];

		$data["name"] = $request->input("name");
		// TODO find a way to set authenticated id universally
		$data["user_id"] = Auth::id();
		$data["description"] = $request->input("description");
		$data["grain_bill"] = $request->input("grain_bill");
		$data["volume"] = $request->input("volume");
		$data["abv"] = $request->input("abv");
		$data["notes"] = $request->input("notes");
		$data["date"] = date("Y-m-d", time());

		if ($request->isMethod("post")) 
		{
			$this->validate(
				$request,
				[
					"name" => "required",
					"volume" => "required|min:1",
					"abv" => "required|min:1",
				]
			);

			$run->insert($data);

			return redirect("runs");
		}

		$data["modify"] = 0;
		return view("run/form", $data);
	}

	public function modify(Request $request, $run_id, Run $run)
	{
		$data = [];

		if ($request->isMethod("post")) 
		{
			$this->validate(
				$request,
				[
					"name" => "required",
					"volume" => "required|min:1",
					"abv" => "required|min:1",
				]
			);

			$run_data = $this->run->find($run_id);

			$run_data->name = $request->input("name");
			$run_data->user_id = 1;
			$run_data->description = $request->input("description");
			$run_data->grain_bill = $request->input("grain_bill");
			$run_data->volume = $request->input("volume");
			$run_data->abv = $request->input("abv");
			$run_data->notes = $request->input("notes");
			$run_data->date = date("Y-m-d", time());

			$run_data->save();

			return redirect("runs");
		}

		$data["modify"] = 0;
		return view("run/form", $data);
	}

	public function delete(Request $request, $run_id, Run $run)
	{
		$selected_run = $run->find($run_id);

		if ($selected_run->delete()) {
			return response("delete successful", 201);
		} else { return response("delete failed", 500); }
	}
}
