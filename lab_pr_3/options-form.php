<html>
<head lang="en">
    <title>Lab 3 PR</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
<div class="container h4 mt-5">
    <hr class="mt-5" style="border-top: 1px solid #a4aca9">
    <form action="http://localhost/lab_pr_3/options-action.php/" method="post" class="form-inline">
        <input type="hidden" name="method" value="head">
        <div class="form-group mb-2 col-3">
            <input type="submit" class="btn btn-lg btn-secondary w-100" value="HEAD request">
        </div>
        <div class="form-group mb-2 col-1">
            <label for="head-input" class="align-middle">URL:</label>
        </div>
        <div class="form-group mb-2 col-8">
            <input type="text" id="head-input" name="head-input" class="form-control w-100">
        </div>
    </form>
    <form action="http://localhost/lab_pr_3/options-action.php/" method="post" class="form-inline">
        <input type="hidden" name="method" value="options">
        <div class="form-group mb-2 col-3">
            <input type="submit" class="btn btn-lg btn-success w-100" value="OPTIONS request">
        </div>
        <div class="form-group mb-2 col-1">
            <label for="options-input" class="align-middle">URL:</label>
        </div>
        <div class="form-group mb-2 col-8">
            <input type="text" id="options-input" name="options-input" class="form-control w-100">
        </div>
    </form>
    <hr class="mt-5" style="border-top: 1px solid #a4aca9">
    <div class="text-center text-primary h1 mt-5 pt-5">
        <strong>^ Test Regex Zone $</strong>
    </div>
    <hr class="mt-5" style="border-top: 1px solid #050cac">
    <form class="text-center" id="regex">
        <input type="hidden" id="regex-method" name="method" value="regex">
        <div class="row">
            <label for="regex-alnum" class="col-4 form-control">Alpha-numeric string</label>
            <input type="text" id="regex-alnum" name="regex-alnum" class="form-control col-5 ml-3">
            <div id="regex-alnum-valid" class="col-2 text-success form-control ml-3" hidden> Valid!</div>
            <div id="regex-alnum-invalid" class="col-2 text-danger form-control ml-3" hidden> NOT valid!</div>
        </div>
        <div class="row">
            <label for="regex-alnum-special-chars" class="col-4 form-control">Alfa-numeric string + [!, ?, #, %, ]</label>
            <input type="text" id="regex-alnum-special-chars" name="regex-alnum-special-chars" class="form-control col-5 ml-3">
            <div id="regex-alnum-special-chars-valid" class="col-2 text-success form-control ml-3" hidden> Valid!</div>
            <div id="regex-alnum-special-chars-invalid" class="col-2 text-danger form-control ml-3" hidden> NOT valid!
            </div>
        </div>
        <div class="row">
            <label for="regex-email" class="col-4 form-control">Email</label>
            <input type="text" id="regex-email" name="regex-email" class="form-control col-5 ml-3">
            <div id="regex-email-valid" class="col-2 text-success form-control ml-3" hidden> Valid!</div>
            <div id="regex-email-invalid" class="col-2 text-danger form-control ml-3" hidden> NOT valid!</div>
        </div>
        <div class="row">
            <label for="regex-first-upper" class="col-4 form-control">First letter of word in uppercase</label>
            <input type="text" id="regex-first-upper" name="regex-first-upper" class="form-control col-5 ml-3">
            <div id="regex-first-upper-valid" class="col-2 text-success form-control ml-3" hidden> Valid!</div>
            <div id="regex-first-upper-invalid" class="col-2 text-danger form-control ml-3" hidden> NOT valid!</div>
        </div>
        <div class="row">
            <label for="regex-length" class="col-4 form-control">String max 20 symbols non alpha-numeric</label>
            <input type="text" id="regex-length" name="regex-length" class="form-control col-5 ml-3">
            <div id="regex-length-valid" class="col-2 text-success form-control ml-3" hidden> Valid!</div>
            <div id="regex-length-invalid" class="col-2 text-danger form-control ml-3" hidden> NOT valid!</div>
        </div>
        <div class="row">
            <input type="submit" class="btn btn-secondary col-4 float-left" value="Submit">
        </div>
    </form>
    <script>
        $('#regex').submit(function(e) {
            e.preventDefault();
            hideAllStatuses();
            $.ajax({
                method: "POST",
                url: "http://localhost/lab_pr_3/options-action.php/",
                data: {
                    method: $('#regex-method').val(),
                    regexAlnum: $('#regex-alnum').val(),
                    regexAlnumSpecialChars: $('#regex-alnum-special-chars').val(),
                    regexEmail: $('#regex-email').val(),
                    regexFirstUpper: $('#regex-first-upper').val(),
                    regexLength: $('#regex-length').val(),
                    dataType: 'json',
                }
            }).done(function (json) {
                let outputArray = JSON.parse(json);
                
                if (outputArray['regex-alnum']) {
                    $('#regex-alnum-valid').removeAttr('hidden');
                } else {
                    $('#regex-alnum-invalid').removeAttr('hidden');
                }

                if (outputArray['regex-alnum-special-chars']) {
                    $('#regex-alnum-special-chars-valid').removeAttr('hidden');
                } else {
                    $('#regex-alnum-special-chars-invalid').removeAttr('hidden');
                }

                if (outputArray['regex-email']) {
                    $('#regex-email-valid').removeAttr('hidden');
                } else {
                    $('#regex-email-invalid').removeAttr('hidden');
                }

                if (outputArray['regex-first-upper']) {
                    $('#regex-first-upper-valid').removeAttr('hidden');
                } else {
                    $('#regex-first-upper-invalid').removeAttr('hidden');
                }

                if (outputArray['regex-length']) {
                    $('#regex-length-valid').removeAttr('hidden');
                } else {
                    $('#regex-length-invalid').removeAttr('hidden');
                }
                
            });
            
        });

        function hideAllStatuses() {
            $('#regex-alnum-valid').attr('hidden', 'hidden');
            $('#regex-alnum-invalid').attr('hidden', 'hidden');
    
            $('#regex-alnum-special-chars-valid').attr('hidden', 'hidden');
            $('#regex-alnum-special-chars-invalid').attr('hidden', 'hidden');
    
            $('#regex-email-valid').attr('hidden', 'hidden');
            $('#regex-email-invalid').attr('hidden', 'hidden');
    
            $('#regex-first-upper-valid').attr('hidden', 'hidden');
            $('#regex-first-upper-invalid').attr('hidden', 'hidden');
    
            $('#regex-length-valid').attr('hidden', 'hidden');
            $('#regex-length-invalid').attr('hidden', 'hidden');
        }
    </script>
    <hr class="mt-5" style="border-top: 1px solid #050cac">
</div>
</body>
</html>
