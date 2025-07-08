<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use DB;

class Offerletter extends Controller
{

    public function index(Request $request)
    {

        if (request()->session()->get('empid') == 'AM090' || request()->session()->get('dept_id') == '6' || request()->session()->get('dept_id') == '1') {
       
        if (request()->ajax()) {
            $data = DB::table('offer_letter_pdf')
                ->orderBy('id', 'desc')
                ->get();

            return DataTables::of($data)
                ->addColumn('sno', function ($row) {
                    return '';
                })
                ->addColumn('url', function ($row) {
                    return '<button class="btn btn-modal approval" data-id="' . $row->id . '">Approval</button>';
                })

                ->addColumn('action', function ($row) {
                    return '<button class="btn btn-modal" data-container=".customer_modal" data-href="' . action([Offerletter::class, 'edit'], [$row->id]) . '">
                    <i class="fi fi-ts-file-edit"></i>
					<span class="tooltiptext">edit</span>
					</button>
                    <button class="btn btn-modal conformdelete" data-id="' . $row->id . '"><i class="fi fi-ts-trash-xmark"></i>
					<span class="tooltiptext">delete</span>
					</button>
                    <a class="btn" href="' . route('viewofferletter', ['id' => base64_encode($row->id)]) . '"  target="_blank"><i class="fi fi-ts-print"></i><span class="tooltiptext">print</span></a>';
                })

                ->rawColumns(['sno', 'url', 'action'])
                ->make(true);
        }

        return view('offerletter/index')->render();
        
    }else{
        return redirect()->to('/workreport');
    }

    }

    public function create(Request $request)
    {
        return view('offerletter/create')->render();
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'emp_name' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female',
            'position' => 'required|string|max:255',
            'date_of_join' => 'required|date',
            'salary' => 'required|numeric|min:0',
            'street' => 'required|string|max:255',
            'town' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'pin' => 'required|digits:6', // Assuming a 6-digit PIN code
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $pid = DB::table('offer_letter_pdf')->orderBy('pr_id', 'desc')->first();

        $numericPart = (int)filter_var($pid->pr_id, FILTER_SANITIZE_NUMBER_INT);

        $newNumericPart = $numericPart + 1;

        $formattedNumericPart = str_pad($newNumericPart, 4, '0', STR_PAD_LEFT);

        $p_id = 'PR ' . $formattedNumericPart;

        $domainData = [
            'pr_id' => $p_id,
            'emp_name' => $request->emp_name,
            'gender' => ($request->gender == 'Male') ? 'Mr' : 'Ms',
            'position' => $request->position,
            'joining_date' => $request->date_of_join,
            'salary' => $request->salary,
            'street' => $request->street,
            'town' => $request->town,
            'city' => $request->city,
            'pin_code' => $request->pin_code,
        ];

        DB::table('offer_letter_pdf')->insert($domainData);

        session()->flash('secmessage', 'Offer Letter Successfully Added.');
        return response()->json(['status' => 1, 'message' => 'Offer Letter Successfully Added.'], 200);
    }

    public function edit($id)
    {

        $offer = DB::table('offer_letter_pdf')->where('id', $id)->first();

        return view('offerletter.edit')->with(compact('offer'));
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'emp_name' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female',
            'position' => 'required|string|max:255',
            'date_of_join' => 'required|date',
            'salary' => 'required|numeric|min:0',
            'street' => 'required|string|max:255',
            'town' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'pin' => 'required|digits:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $domainData = [
            'emp_name' => $request->emp_name,
            'gender' => ($request->gender == 'Male') ? 'Mr' : 'Ms',
            'position' => $request->position,
            'joining_date' => $request->date_of_join,
            'salary' => $request->salary,
            'street' => $request->street,
            'town' => $request->town,
            'city' => $request->city,
            'pin_code' => $request->pin_code,
        ];

        DB::table('offer_letter_pdf')->where('id', $id)->update($domainData);

        session()->flash('secmessage', 'Offer Letter updated successfully.');
        return response()->json(['status' => 1, 'message' => 'Offer Letter updated successfully.'], 200);
    }

    public function destroy($id)
    {

        $upd = DB::table('offer_letter_pdf')->where('id', $id)->delete();
        session()->flash('secmessage', 'Offer Letter Deleted Successfully!');

        return response()->json(['status' => 1, 'message' => 'Offer Letter Deleted Successfully!'], 200);
    }

    public function approval(Request $request){

        $id = $request->id;
        $type = $request->type;

        if ($type == 'web') {

            $update = DB::table('proposal_pdf')->where('id',$id)->update(['status'=>1]);
            session()->flash('secmessage', 'Updated successfully.');
            return response()->json(['status' => 1, 'message' => 'Updated successfully.'], 200);

        } elseif ($type == 'digital') {

            $update = DB::table('digital_proposal_pdf')->where('id',$id)->update(['status'=>1]);
            session()->flash('secmessage', 'Updated successfully.');
            return response()->json(['status' => 1, 'message' => 'Updated successfully.'], 200);

        } elseif ($type == 'offer') {
         
            $update = DB::table('offer_letter_pdf')->where('id',$id)->update(['status'=>1]);
            session()->flash('secmessage', 'Updated successfully.');
            return response()->json(['status' => 1, 'message' => 'Updated successfully.'], 200);

        }

    }

    public function viewofferletter($id)
    {
        $id=base64_decode($id);
        $offer = DB::table('offer_letter_pdf')->where('id', $id)->first();

        $offer->words = $this->convertToIndianWords($offer->salary);

        $offer->salary = $this->indian_number_format($offer->salary);

        return view('pdf.offerletter')->with(compact('offer'));
    }

    private function indian_number_format($number)
    {
        $number = (string)$number;
        $length = strlen($number);

        if ($length <= 3) {
            return $number;
        }

        $last_three = substr($number, -3);
        $remaining = substr($number, 0, -3);
        $formatted = '';

        while (strlen($remaining) > 2) {
            $formatted = ',' . substr($remaining, -2) . $formatted;
            $remaining = substr($remaining, 0, -2);
        }

        if ($remaining) {
            $formatted = $remaining . $formatted;
        }

        return $formatted . ',' . $last_three;
    }

    private function convertToIndianWords($number)
    {
        $words = [
            0 => '',
            1 => 'One',
            2 => 'Two',
            3 => 'Three',
            4 => 'Four',
            5 => 'Five',
            6 => 'Six',
            7 => 'Seven',
            8 => 'Eight',
            9 => 'Nine',
            10 => 'Ten',
            11 => 'Eleven',
            12 => 'Twelve',
            13 => 'Thirteen',
            14 => 'Fourteen',
            15 => 'Fifteen',
            16 => 'Sixteen',
            17 => 'Seventeen',
            18 => 'Eighteen',
            19 => 'Nineteen',
            20 => 'Twenty',
            30 => 'Thirty',
            40 => 'Forty',
            50 => 'Fifty',
            60 => 'Sixty',
            70 => 'Seventy',
            80 => 'Eighty',
            90 => 'Ninety'
        ];

        $units = ['', 'Thousand', 'Lakh', 'Crore'];
        $number = (int) $number;

        if ($number == 0) {
            return 'Zero';
        }

        $parts = [];
        $counter = 0;

        while ($number > 0) {
            $divider = ($counter == 1) ? 10 : 100;
            $chunk = $number % $divider;
            $number = (int) ($number / $divider);

            if ($chunk > 0) {
                $parts[] = $this->convertChunkToWords($chunk, $words) . ' ' . $units[$counter];
            }

            $counter++;
        }

        return implode(' ', array_reverse($parts));
    }

    private function convertChunkToWords($chunk, $words)
    {
        if ($chunk < 20) {
            return $words[$chunk];
        }

        if ($chunk < 100) {
            return $words[($chunk - $chunk % 10)] . ($chunk % 10 ? ' ' . $words[$chunk % 10] : '');
        }

        return $words[(int) ($chunk / 100)] . ' Hundred' . ($chunk % 100 ? ' and ' . $this->convertChunkToWords($chunk % 100, $words) : '');
    }
}
