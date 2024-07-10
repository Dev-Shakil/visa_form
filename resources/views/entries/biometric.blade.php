<!DOCTYPE html>
<html lang="en">
<head>
    @include('layout.head')
</head>
<body>
  @include('layout.navbar')
    <div class="w-[60%] mx-auto shadow-lg rounded-lg pb-2 mt-4">
  
      @foreach ($candidates as $candidate)@endforeach
      <div class="py-2 px-4 text-xl font-semibold w-full rounded-lg shadow-md text-[#082F2C] bg-[#ADCCC8]">Enter Biometric Information</div>
      
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
                    <label for="embassy_visa_no" class="font-bold text-lg">
                      Appointment Date <span class="text-red-500">*</span>
                    </label>
                    <input
                      type="text"
                      id="appointment_date"
                      name="appointment_date"
                      class="form-control p-2 rounded-lg w-full uppercase"
                      required
                      placeholder=""
                    />
                  </div>
                  <div class="py-2 flex flex-col gap-2">
                    <label for="bio_status" class="font-bold text-lg">
                      Biometric Status <span class="text-red-500">*</span>
                    </label>
                    <select
                      id="bio_status"
                      name="bio_status"
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
              Add Biometric Status
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