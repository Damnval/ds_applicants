<?php
namespace App\Services;

use App\Applicant;

class ApplicantService
{
	/**
	 * Logic and service in getting all applicants
	 * @return Collection Applicant Collection
	 */
	public function getApplicants()
	{
		return $data = Applicant::all();
	}

	/**
	 * Logic and service in deleting applicant record
	 * @param  Int $id
	 * @return boolean
	 */
	public function destroy($id)
	{
		$applicant = Applicant::find($id);
		return $applicant->delete();
	}

	/**
	 * Logic and sevice in getting applicant
	 * @param  Int $id
	 * @return Object
	 */
	public function getApplicant($id)
	{
		$applicant = Applicant::find($id);
		return $applicant;
	}

	/**
	 * Logic and service in updating applicant Info
	 * @param  Object $request
	 * @param  int $id
	 * @return boolean
	 */
	public function updateApplicant($request, $id)
	{
		$data = $request->all();
		$applicant = Applicant::find($id);
		return $applicant->update($data);
	}

	/**
	 * Logic and service in storing new applicant
	 * @param  Object $request User Input
	 * @return Object
	 */
	public function store($data)
	{
		$applicant = new Applicant();
		$applicant->fill($data);
		$applicant->save();
		return $applicant;
	}
}
