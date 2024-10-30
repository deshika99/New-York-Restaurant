@extends ('AdminDashboard.master')

@section('content')

<div class="content-header">
    <h2 class="content-title">Add Customer</h2>
        <div>
            <button class="btn btn-light rounded font-sm mr-5 text-body hover-up">Save to draft</button>
            <button class="btn btn-md rounded font-sm hover-up">Publich</button>
         </div>      
</div>

<div class="col-lg-12"> 
    <div class="card mb-4">
        <div class="card-header">
            <h4>Basic</h4>
        </div>
        <div class="card-body">
            <form>
                <div class="row">   
                    <div class="col-lg-6">
                        <div class="mb-4">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" placeholder="Type first name here" class="form-control" id="first_name" />
                        </div>
                    </div>   
                    <div class="col-lg-6">
                        <div class="mb-4">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" placeholder="Type last name here" class="form-control" id="last_name" />
                        </div>
                    </div>
                </div>
                <div class="row">   
                    <div class="col-lg-6">
                        <div class="mb-4">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <input type="text" placeholder="Enter phone number" class="form-control" id="phone_number" />
                        </div>
                    </div>   
                    <div class="col-lg-6">
                        <div class="mb-4">
                            <label for="whatsapp_number" class="form-label">WhatsApp Number</label>
                            <input type="text" placeholder="Enter WhatsApp number" class="form-control" id="whatsapp_number" />
                        </div>
                    </div>
                </div>
                <div class="row">   
                    <div class="col-lg-6">
                        <div class="mb-4">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" placeholder="Type your email here" class="form-control" id="email" />
                        </div>
                    </div>   
                    <div class="col-lg-6">
                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" placeholder="Type your password here" class="form-control" id="password" />
                        </div>
                    </div>
                <div class="row">
                    <div class="col-lg-13">  
                        <div class="mb-4">
                            <label class="form-label">Note</label>
                            <textarea placeholder="Type here" class="form-control" rows="4"></textarea>
                        </div>
                    </div>
                    </div>

                </div>
            </form>
        </div>
       
    </div>
</div>

                                    


@endsection