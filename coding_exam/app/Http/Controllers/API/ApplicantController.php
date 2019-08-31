<?php

namespace App\Http\Controllers\API;

use Validator;
use Artisan;
use App\Applicant;
use Illuminate\Http\Request;
use App\Services\ApplicantService;
use App\Http\Controllers\Controller;

class ApplicantController extends Controller
{
	public function __construct(ApplicantService $applicantService)
	{
		$this->applicantService = $applicantService;
	}

	/**
	 * Will get all applicants from applicants table
	 * @return Mixed View and Varibles
	 */
	public function index()
	{
		$applicants = $this->applicantService->getApplicants();
		return view('applicant.index', compact('applicants'))->render();
	}

	/**
	 * Remove applicant from resource
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$applicant = $this->applicantService->destroy($id);
		return response()->json($applicant);
	}

	/**
	 * Show edit page for a certain applicant record
	 * @param  int $id [description]
	 * @return Mixed View and Varibles
	 */
	public function edit($id)
	{
		$applicant = $this->applicantService->getApplicant($id);
		return view('applicant.edit', compact('applicant'))->render();
	}

	/**
	 * Update applicant detail
	 * @param  Request $request User Input
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		$applicant = $this->applicantService->updateApplicant($request, $id);
		return response()->json($applicant);
	}

	/**
	 * Go to create applicant page
	 * @return blade
	 */
	public function create()
	{
		return view('applicant.create');
	}

	/**
	 * Storing new applicant
	 * @param  Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$data = $request->all();
		$validator = Validator::make($data, Applicant::createRules());

		if ($validator->fails()) {
			return response()->json(['errors'=>$validator->errors()]);
        }

		$applicant = $this->applicantService->store($data);
		return response()->json($applicant);
	}

	/**
	 * Generates Dummy Applicants
	 * @return \Illuminate\Http\Response
	 */
	public function generateDummyApplicant()
	{
		Artisan::call('db:seed');
		$applicants = $this->applicantService->getApplicants();
		return response()->json($applicants);
	}
}

