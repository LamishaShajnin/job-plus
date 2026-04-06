@extends('front.layouts.app')

@section('main')
<section class="section-5">
    <div class="container my-5">
        <div class="py-lg-2">&nbsp;</div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-5">
                <div class="card shadow border-0 p-5">
                    <h1 class="h3">Register</h1>
                    <form action="" name="RegistrationForm" id="RegistrationForm">
                        <div class="mb-3">
                            <label for="" class="mb-2">Name*</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name">
                            <p></p>
                        </div> 
                        <div class="mb-3">
                            <label for="" class="mb-2">Email*</label>
                            <input type="text" name="email" id="email" class="form-control" placeholder="Enter Email">
                            <p></p>
                        </div> 
                        <div class="mb-3">
                            <label for="" class="mb-2">Password*</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password">
                            <p></p>
                        </div> 
                        <div class="mb-3">
                            <label for="" class="mb-2">Confirm Password*</label>
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Please Confirm Password">
                            <p></p>
                        </div> 
                        <button class="btn btn-primary mt-2">Register</button>
                    </form>                    
                </div>
                <div class="mt-4 text-center">
                    <p>Have an account? <a  href="login.html">Login</a></p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('customJs')
<script>
$("#registrationFOrm").submit(function(e){
    e. preventDefault();

    $.ajax({
        url:'{{ route("account.processRegistration") }}',
        type:'post',
        data: $("#registrationForm").serializeArray(),
        datatype: 'json',
        success:function(response){
            if (response.status == false){
                var errors = response.errors;
                if (errors.name){
                    $("#name").addclass('is-invalid')
                    .siblings('p')
                    .addclass('invalid-feedback')
                    .html(errors.name)
                }else{
                    $("#name").removeclass('is-invalid')
                    .siblings('p')
                    .removeclass('invalid-feedback')
                    .html('')

                }

                if (errors.email){
                    $("#email").addclass('is-invalid')
                    .siblings('p')
                    .addclass('invalid-feedback')
                    .html(errors.email)
                }else{
                    $("#email").removeclass('is-invalid')
                    .siblings('p')
                    .removeclass('invalid-feedback')
                    .html('')

                }

                if (errors.password){
                    $("#password").addclass('is-invalid')
                    .siblings('p')
                    .addclass('invalid-feedback')
                    .html(errors.password)
                }else{
                    $("#password").removeclass('is-invalid')
                    .siblings('p')
                    .removeclass('invalid-feedback')
                    .html('')

                }

                if (errors.confirm_password){
                    $("#confirm_password").addclass('is-invalid')
                    .siblings('p')
                    .addclass('invalid-feedback')
                    .html(errors.password)
                }else{
                    $("#confirm_password").removeclass('is-invalid')
                    .siblings('p')
                    .removeclass('invalid-feedback')
                    .html('')

                }
            }

        }

    });

});    
</script>

@endsection