<?php


namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use getID3;

class HomeController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();

        return view("welcome", compact("users"));
    }

    public function create()
    {
        return view("create");
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'mobile_number' => 'required|numeric|digits:10|unique:users,mobile_number',
            'password' => 'required',
            'profile' => 'file|mimes:jpg,png,jpeg',
        ]);

        $user = User::create([
            "name" => $request->input("name"),
            "email" => $request->input("email"),
            "mobile_number" => $request->input("mobile_number"),
            "password" => Hash::make($request->input("password"))
        ]);

        if ($request->file("profile")) {
            $profile = $request->file('profile');
            $unique_file_name = uniqid() . '.' . $profile->getClientOriginalExtension();
            $path = $profile->storeAs('uploads', $unique_file_name, 'public');
            $user->profile = $path;
            $user->save();
        }

        Session::flash('success', 'User added successful.');
        return redirect()->route("home");
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view("edit", compact("user"));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'mobile_number' => 'required|numeric|digits:10|unique:users,mobile_number,' . $id,
            'profile' => 'file|mimes:jpg,png,jpeg',
        ]);

        $user = User::find($id);
        $user->name = $request->input("name");
        $user->email = $request->input("email");
        $user->mobile_number = $request->input("mobile_number");
        if ($request->input("password")) {
            $user->password = Hash::make($request->input("password"));
        }
        $user->save();

        if ($request->file("profile")) {
            if ($user->profile) {
                if (file_exists(storage_path("app/public/$user->profile"))) {
                    unlink(storage_path("app/public/$user->profile"));
                }
            }

            $profile = $request->file('profile');
            $unique_file_name = uniqid() . '.' . $profile->getClientOriginalExtension();
            $path = $profile->storeAs('uploads', $unique_file_name, 'public');
            $user->profile = $path;
            $user->save();
        }

        Session::flash('success', 'Update user successful.');
        return redirect()->route("home");
    }

    public function delete($id)
    {
        $user = User::find($id);

        if ($user->profile) {
            if (file_exists(storage_path("app/public/$user->profile"))) {
                unlink(storage_path("app/public/$user->profile"));
            }
        }

        $user->delete();

        Session::flash('success', 'User delete successful.');
        return redirect()->route("home");
    }

    public function audio_duration()
    {
        $audioFilePath = storage_path("app/public/uploads/teri-mitti.mp3");

        if (file_exists($audioFilePath)) {
            $getID3 = new getID3();

            $fileInformation = $getID3->analyze($audioFilePath);

            if (isset($fileInformation['playtime_string'])) {
                return [
                    "file_name" => $fileInformation['filename'],
                    "file_size" => $fileInformation['filesize'],
                    "audio_duration" => $fileInformation['playtime_string']
                ];
            }

            return [
                "Ops! something went wrong!"
            ];
        }

        return [
            "File not found.."
        ];
    }

    public function location_distance(Request $request)
    {
        $earthRadius = $request->input("unit") === 'km' ? 6371 : 3958.8;

        $lat1 = deg2rad($request->input("origin_lat"));
        $lng1 = deg2rad($request->input("origin_long"));
        $lat2 = deg2rad($request->input("destination_lat"));
        $lng2 = deg2rad($request->input("destination_long"));

        // Haversine formula
        $dLat = $lat2 - $lat1;
        $dLng = $lng2 - $lng1;

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos($lat1) * cos($lat2) *
            sin($dLng / 2) * sin($dLng / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        // Distance in the specified unit (km or miles)
        $distance = $earthRadius * $c;

        return [
            "distance" => number_format($distance, 2)." ".$request->input("unit")
        ];
    }
}
