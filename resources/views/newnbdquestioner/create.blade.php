<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Paid Marketing Questionaire</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        .questionnaire {
            background: #fff;
        }

        input:focus,
        textarea:focus {
            outline: none !important;
            box-shadow: none !important;
            border-color: #dee2e6 !important;
        }

        input::placeholder,
        textarea::placeholder {
            color: #9b9a9a !important;
        }

        .header-sec {
            position: sticky;
            top: 0px;
			z-index:9999;
        }

        .frm-sec {
            background: #f5f5f5;
        }

        .header-sec {
            background: #fff;
            border-bottom: 2px solid #2c8fcd;
			box-shadow:0px 8px 7px #d9d9d99e;
        }

        .breadcrumbs {
            color: #050038;
            font-weight: 700;
            letter-spacing: -2px;
            font-size: 30px;
            line-height: 45px;
            font-family: 'Work Sans', sans-serif;
        }

        .hed_con {
            width: fit-content;
        }

        .hed_con p {
            font-family: 'Inter', sans-serif;
        }

        .hed-two {
            color: #050038;
            font-weight: 700;
            letter-spacing: -2px;
            font-size: 30px;
            line-height: 27px;
            font-family: 'Work Sans', sans-serif;
        }

        .form-control {
            font-size: 14px;
        }

        .g-recaptcha div {
            padding: 0px !important;
    position: relative;
    margin: 0px !important;
    transform: scale(0.8);
    width: fit-content !important;
    position: relative;
    margin-left: -20px !important;
    margin: 15px 0px;
    left: 12px;
        }

        /* .ques-frm{display:grid;grid-template-columns:47% 47%;justify-content:space-between;} */
		 .ques-frm{padding: 20px  0px;background: #fff;margin-top: 30px;}
        .ques-frm div {
            background: #fff;
            padding:30px 40px  10px;
            font-family: 'Inter', sans-serif;
            font-size: 15px;
			position:relative;
        }
		.btn.btn-primary{display: flex;text-align: center;padding: 5px 20px 7px;border-radius: 25px;margin: auto;}
	
		 .ques-frm .mb-3{margin-bottom:0px!important}
		.ques-frm div input ,.ques-frm div select{height:50px;}
		input:focus ,textarea:focus {
  background-color: #e8f0fe6e !important; 
    border-color: #86b7fe !important;
}
select:focus {
 background-color: #e8f0fe6e !important; 
  border-color: #86b7fe !important;
 box-shadow:none !important;
}
			 .ques-frm div label{position:absolute;background:#fff;left: 50px;top: 20px;padding:0px 5px;}
	 .ques-frm #scope_of_work_group  label,.ques-frm #monthly_budget_group  label,.ques-frm div .check-box label{position:relative;background:#fff;left: 0px;top: 0px;margin-bottom: 10px;}
.ques-frm #scope_of_work_group input ,.ques-frm #monthly_budget_group input{height:auto;}
        .ques-frm textarea {
			padding-top:15px;
            font-size: 14px;
        }

        .ques-frm div .cap-pad {
            padding: 0px;
        }

        textarea {
            resize: none;
        }

        .yes-div {
            border: 1px solid hsl(0deg 0% 0% / 30%);
            padding: 20px 15px !important;
            display: none;
        }

        .mb-3 .captchasec {
            padding: 0px;
        }

        .g-recaptcha {
            margin: 15px 0px !important;
        }

        @media(max-width:900px) {
            .breadcrumbs {
                color: #050038;
                font-size: 24px;
            }

            .hed-two {
                color: #050038;
                font-size: 24px;
                line-height: 35px;
            }

            .container {
                padding: 0px;
            }

            .header-menu img {
                width: 150px;
            }
        }

        @media(max-width:400px) {
            .header-menu img {
                width: 120px;
            }
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="questionnaire">
    <section class="header-sec">
        <div class="header-menu container  p-3 d-flex justify-content-between align-items-end">
            <div>
                <a href=""><img src="https://www.appacmedia.com/images/appac-logo.svg" class="img-fluid" width="160px" alt=""></a>
            </div>
           <!-- <div>
                <p class="m-0 breadcrumbs">/ Paid Marketing Questionaire</p>
            </div> -->
        </div>
    </section>
    <section class="frm-sec">
        <div class="container p-3">
            <!--<div class="row">
            <div class="col-lg-8 mt-3 mb-3 m-auto px-4">
                <div class="hed_con">
                <h2 class="hed-two mb-2">Let's discuss about your Project</h2>
                <p class="m-0">Paid Marketing Questionaire</p>
                </div>
            </div>
		</div>-->
            <div class="row">
                <div class="col-lg-8 m-auto p-3">
                    <div class="container">
					<h1>Need and Scope Analysis</h1>
                        <form class="ques-frm" method="POST" id="quesfrm">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name <span style=color:red;>*</span></label>
                                <input type="text" name="name" id="name" class="form-control" maxlength="100" placeholder="" required>
                            </div>
                            <div class="mb-3">
                                <label for="mobile" class="form-label">Mobile <span style=color:red;>*</span></label>
                                <input type="number" name="mobile" id="mobile" class="form-control" maxlength="15" placeholder="" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email ID <span style=color:red;>*</span></label>
                                <input type="email" maxlength="255" name="email" id="email" class="form-control" placeholder="" required>
                            </div>
                            <div class="mb-3">
                                <label for="business_name" class="form-label">Business Name <span style=color:red;>*</span></label>
                                <input type="text" maxlength="255" name="business_name" class="form-control" id="business_name" placeholder="" required>
                            </div>
                            <div class="mb-3">
                                <label for="website_link" class="form-label">Website (If you have website)</label>
                                <input type="text" name="website_link" class="form-control" id="website_link" maxlength="500" placeholder="">
                            </div>
                            <div class="mb-3">
                                <label class="mb-2" for="turnover">Turnover <span style=color:red;>*</span></label>
                                <input class="form-control" name="turnover" placeholder="" id="turnover" maxlength="50" required>
                            </div>
                            <div class="mb-3">
                                <label class="mb-2" for="business_type">Business TypeL <span style=color:red;>*</span></label>
                                <select name="business_type" id="business_type" class="form-select">
                                    <option value="">Select Type</option>
                                    <option value="B2B - Manufacturing">B2B - Manufacturing</option>
                                    <option value="Healthcare">Healthcare</option>
                                </select>
                            </div>

                            <div class="mb-3" id="scope_of_work_group">
                                <label class="mb-2" for="scope_of_work">Scope of Work <span style="color:red;">*</span></label><br><br>
                                <input type="checkbox" id="scope_of_work" name="scope_of_work" value="Web design & development" class="scope-group">
                                <label for="scope_of_work"> Web design & development</label><br>

                                <input type="checkbox" id="scope_of_work1" name="scope_of_workf" value="Web hosting and maintenance" class="scope-group">
                                <label for="scope_of_work1"> Web hosting and maintenance</label><br>

                                <input type="checkbox" id="scope_of_work2" name="scope_of_works" value="Email marketing" class="scope-group">
                                <label for="scope_of_work2"> Email marketing</label><br>

                                <input type="checkbox" id="scope_of_work3" name="scope_of_workt" value="Digital marketing " class="scope-group">
                                <label for="scope_of_work3"> Digital marketing </label>
                            </div>

                            <div class="mb-3" id="monthly_budget_group">
                                <label class="mb-2" for="target_audience">Monthly Budget <span style="color:red;">*</span></label><br><br>
                                <input type="checkbox" id="monthly_budget" name="monthly_budget" value="50k to 1 Lakh" class="budget-group">
                                <label for="monthly_budget"> 50k to 1 lakh</label><br>

                                <input type="checkbox" id="monthly_budget1" name="monthly_budget" value="1 Lakh - 2 Lakh" class="budget-group">
                                <label for="monthly_budget1"> 1 Lakh - 2 Lakh</label><br>

                                <input type="checkbox" id="monthly_budget2" name="monthly_budget" value="2 Lakh - 5 Lakh" class="budget-group">
                                <label for="monthly_budget2"> 2 lakh - 5 lakh</label>
                            </div>

                            <div class="mb-3">
                                <label class="mb-2" for="description">Description <span style=color:red;>*</span></label>
                                <textarea class="form-control" name="description" placeholder="" id="description" rows="4" required></textarea>
                            </div>

                            <!-- <div class="p-0 m-0">
                                <div class="captchasec p-0 m-0">
                                    <div class="g-recaptcha p-0 m-0" data-sitekey="6LcsQFArAAAAAHnJXAAICT4L8O4p6xbazgD4_94a" data-callback="verifyCaptcha"></div>
                                    <div class="p-0 m-0" id="g-recaptcha-error"></div>
                                </div>
                            </div> -->
                            <button type="submit" name="subbtn" id="applyBtn" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://www.google.com/recaptcha/api.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            // $('.scope-group').on('change', function() {
            //     $('.scope-group').not(this).prop('checked', false);
            // });

            $('.budget-group').on('change', function() {
                $('.budget-group').not(this).prop('checked', false);
            });
        });

        function verifyCaptcha() {
            document.getElementById('g-recaptcha-error').innerHTML = '';
        }

        $(document).ready(function() {
            $('#quesfrm').submit(function(event) {
                event.preventDefault();

                // var response = grecaptcha.getResponse();
                // if (response.length == 0) {
                //     $('#g-recaptcha-error').html('<span style="color:red;">This field is required.</span>');
                //     return false;
                // }

                $.ajax({
                    url: '{{ route("newnbdquestioner.store") }}',
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: "json",
                     beforeSend: function() {
                        $("#applyBtn").text("Submitting...").prop("disabled", true);
                    },
                    success: function(response) {
                        if (response.status == 1) {
                            alert("Form Submitted Successfully.");
                            $("#applyBtn").text("Submit").prop("disabled", false);
                            location.reload();
                        } else {
                            $(".error").remove(); // clear existing errors
                            $("#applyBtn").text("Submit").prop("disabled", false);
                        }
                    },
                    error: function(xhr) {
                        $(".error").remove(); // clear previous errors

                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            let allErrors = '';

                            for (let field in errors) {
                                let errorMessage = errors[field][0];
                                allErrors += errorMessage + '\n';

                                // Special cases for checkbox groups
                                if (field === 'scope_of_work') {
                                    $('#scope_of_work_group').append('<span class="error" style="color:red; font-size:12px;">' + errorMessage + '</span>');
                                } else if (field === 'monthly_budget') {
                                    $('#monthly_budget_group').append('<span class="error" style="color:red; font-size:12px;">' + errorMessage + '</span>');
                                } else {
                                    $('#' + field).after('<span class="error" style="color:red; font-size:12px;">' + errorMessage + '</span>');
                                }
                            }

                            alert(allErrors); // one alert with all errors
                        } else {
                            alert("There was an error with the form submission.");
                        }
                        $("#applyBtn").text("Submit").prop("disabled", false);
                    }

                });
            });
        });
    </script>

</body>

</html>