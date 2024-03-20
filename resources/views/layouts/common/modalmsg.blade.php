    <!-- Modal Error Message -->
    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="ModalInfo" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title m-0 pt-1 pl-0" id="modal_title"></h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="error_modal_body">

                </div>
                <div class="modal-footer">
                    <button type="button" id="error_modal_button" class="btn btn-outline-primary"
                        data-bs-dismiss="modal">close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Error Message -->
    <div class="modal fade" id="message_modal" tabindex="-1" role="dialog" aria-labelledby="ModalInfo"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title m-0 pt-1 pl-0" id="message_modal_title"></h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="message_modal_body">

                </div>
                <div class="modal-footer">
                    <button type="button" id="message_modal_button" class="btn btn-outline-primary"
                        data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function successModal(result) {
            $("#message_modal_title").html("Success");
            $("#message_modal_body").html("<div class='alert alert-info' role='alert'> " + result + "</div>");
            $("#message_modal").modal("show");
        }

        function customErrorModal(result) {
            $("#message_modal_title").html("Alert");
            $("#message_modal_body").html("<div class='alert alert-danger' role='alert'> " + result + "</div>");
            $("#message_modal").modal("show");
        }

        function errorModal(error) {
            $("#message_modal_title").html("Alert");
            $("#message_modal_body").html("");
            //var errorData=JSON.parse(error.responseText);
            var errorData = error.responseJSON;
            // console.log(error);

            // errorData.message = errorData.message.replace('The given data was invalid.', 'আপনার প্রদানকৃত  তথ্য সঠিক নয় ।');
            var error_body = '';
            // console.log("Error Info: ",errorData.message);
            for (r in errorData.errors) {
                error_body += `<div class="alert alert-danger" role="alert">${errorData.errors[r][0]}</div>`;
            }
            $("#message_modal_body").html(error_body);
            // $("#message_modal_body").modal("show");
            $("#message_modal").modal("show");
        }

        function messageModal(resultData) {
            $("#message_modal_title").html(resultData.title);
            $("#message_modal_body").html("<div class='alert " +
                resultData.alert_type + "' role='alert'> " + resultData.message + "</div>");
            $("#message_modal").modal("show");
        }
    </script>
