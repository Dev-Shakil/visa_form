<!DOCTYPE html>
<html lang="en">
<head>
    @include('layout.head')
</head>
<body>
  @include('layout.navbar')
    <div class="w-[60%] mx-auto shadow-lg rounded-lg pb-2 mt-4">
  
      @foreach ($candidates as $candidate)@endforeach
      <div class="py-2 px-4 text-xl font-semibold w-full rounded-lg shadow-md text-[#082F2C] bg-[#ADCCC8]">Enter Medical Information</div>
      
        <form id="medicalInput" class="pt-4">
          @csrf
          <div class="w-full flex flex-col justify-center items-center">

            <datalist id="candidates">
                @foreach ($candidates as $candidate)
                    <option value="{{ $candidate->candidate_id }}">
                        <b class="text-danger">Passport no: {{ $candidate->passport_number }},</b>
                        Candidate Name: {{ $candidate->name }}
                    </option>
                @endforeach
            </datalist>
            <div class="w-1/2 flex justify-center items-center">
              <label for="candidate_id" class="font-bold text-lg w-1/3">
                Candidate ID <span class="text-red-500">*</span>
              </label>
              <input
                type="text"
                list="candidates"
                id="candidate_id"
                onchange="getdata()"
                name="candidate_id"
                class="w-2/3 p-2 rounded-lg border border-red-200 uppercase"
                required
                placeholder=""
                aria-label="Candidate ID"
              />
            </div>
            <div class="w-full mt-3">
                {{-- <input type="hidden" name="" id="candidate_id" value="{{$id}}" /> --}}
                <div class="px-10 gap-x-10 grid md:grid-cols-2">
                  <div class="py-2 flex flex-col gap-2">
                  <div class="font-bold text-lg">Candidate Name <span class="text-red-500">*</span></div>
                  <input type="text" id="candidate_name" name="candidate_name" class="form-control p-2 rounded-lg w-full uppercase" required placeholder="" />
                </div>

               
                <div class="py-2 flex flex-col gap-2">
                    <label for="medical_name" class="font-bold text-lg">
                      Medical Center Name <span class="text-red-500">*</span>
                    </label>
                    <div class="flex gap-2">
                      <input
                        type="text"
                        id="medical_name"
                        name="medical_name"
                        class="form-control p-2 rounded-lg w-full uppercase"
                        required
                        placeholder=""
                      />
                      <button class="px-4 py-2 bg-blue-500 text-white rounded-lg">
                        Add
                      </button>
                    </div>
                  </div>
                <div class="py-2 flex flex-col gap-2">
                  <div class="font-bold text-lg">Medical Serial No</div>
                  <input type="text" id="medical_sl" name="medical_sl" class="form-control p-2 rounded-lg w-full uppercase" placeholder="" />
                </div>
              
                <div class="py-2 flex flex-col gap-2">
                  <div class="font-bold text-lg">Medical Exam Date</div>
                  <input type="date" id="medical_exam_date" name="medical_exam_date" class="form-control p-2 rounded-lg w-full uppercase" placeholder="" />
                </div>
                <div class="py-2 flex flex-col gap-2">
                  <div class="font-bold text-lg">Medical Expire Date</div>
                  <input type="date" id="medical_expire_date" name="medical_expire_date" class="form-control p-2 rounded-lg w-full uppercase" placeholder="" />
                </div>
                <div class="py-2 flex flex-col gap-2">
                <label for="candidate_fit_status" class="font-bold text-lg">
                  Medical Status <span class="text-red-500">*</span>
                </label>
                <select
                  id="medical_status"
                  name="medical_status"
                  class="form-control p-2 rounded-lg w-full"
                  required
                >
                  <option value="" disabled selected>Select status</option>
                  <option value="FIT">FIT</option>
                  <option value="UNFIT">UNFIT</option>
                </select>
              </div>
                
                
            </div>
            
              
          </div>
          <div class="text-center pt-3">
            <button
              type="submit"
              class="bg-[#289788] mb-2 hover:bg-[#074f56] p-3 rounded text-white font-semibold"
            >
              Add Candidate Medical
            </button>
          </div>
      </form>
    </div>

    @include('layout.script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
       function getdata() {
                var id = document.getElementById('candidate_id').value;

                fetch('/user/embassy/' + id, {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                    })
                    .then(response => response.json())
                    // Parse the response as JSON
                    .then(data => {
                       
                        document.getElementById('candidate_id').value = data.data.candidate_name;
                    })
                    .catch(error => {
                        // Handle any errors that occurred during the request
                        // ...
                    });
                document.getElementById('totalCancel').innerHTML = rowsCount;
            }
    </script>
</body>
</html>