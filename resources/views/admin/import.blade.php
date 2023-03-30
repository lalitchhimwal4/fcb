@section('title','Admin')
@extends('layouts.admin.main')

@section('content')
<div class="content-wrapper">
  <div class="content-header">
    <h1 class="m-0">Import Old Data</h1>
  </div>

  <section class="content">
    <div>
      <div class="import-wrapper"></div>
      <div class="member-activation-container">
        <div class="activation-note-container">
          This import feature is only for Providers and Provider Offices.<br />
          <div class="activation-note-small">
            <strong>Note:</strong> This import is designed to create the Providers and Provider Offices from the previous database. Please do not refresh the page while the import is running.<br />
            For the Provider and Office enrollments to be saved correctly, please import the Provider Offices first and then the Providers.<br />
            When the providers are created, they are automatically assigned a new password. Once the providers are set with the provider offices,
            an email is send with the provider's information to the email associated with the office.
            The Provider Offices will have to communicate the login credentials for each provider associated to it and have the providers reset their password after login.<br /><br />
            The headers for the import file is fixed and should be as following:<br />
            <ul>
              <li><strong>Provider Offices:</strong> Clinic Name, Address1, Address2, Address3, City, Province, Postal Code, Latitude, Longitude, Telephone, Fax, Email, Speciality</li>
              <li><strong>Providers:</strong> First Name, Last Name, License Number, Speciality, Clinic Name, Address1, City, Telephone</li>
            </ul>
          </div>
        </div>
      </div>

      @csrf
      <div>
        <div class="d-flex mt-2">
          <div class="import-header">
            <label>Select the import file type: </label>
          </div>
          <div>
            <select class="form-control select-import-type" name="file_type">
              <option value="provider_offices">Provider Offices</option>
              <option value="providers">Providers</option>
            </select>
          </div>
        </div>
        <div class="d-flex mt-2">
          <div class="import-header">
            <label>Select the file: </label>
          </div>
          <div>
            <input type="file" name="import_file" accept="text/csv">
          </div>
        </div>
        <div class="d-flex mt-2">
          <div>
            <a class="btn btn-primary" id="sumbit_import" href="#"><i class="fas fa-upload"></i> Import</a>
          </div>
        </div>
        <div class="loader hidden"></div>
      </div>

      <div class="import-result-container">
        <div class="print-btn-container">
          <span class="btn btn-primary import-result-print"><i class="fa fa-print" aria-hidden="true"></i> Print</span>
        </div>
        <div class="import-result"></div>
      </div>

    </div>
  </section>
</div>
@endsection
@section('footerjs')
<script type="text/JavaScript" src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.0/jQuery.print.js"></script>
<script>
  $(document).ready(function() {
    $('#sumbit_import').on('click', function() {
      const token = $('input[name="_token"]').val();
      const file_type = $('select[name="file_type"]').val();
      const import_file = $('input[name="import_file"]').prop('files')[0];

      let form_data = new FormData();
      form_data.append('_token', token);
      form_data.append('file_type', file_type);
      form_data.append('import_file', import_file);

      $('.import-result-container').removeClass('active');
      $('.import-result').html('');
      $('.import-wrapper').html('');
      $('.loader').removeClass('hidden');

      $.ajax({
        url: "{{route('admin.import')}}",
        type: 'POST',
        data: form_data,
        processData: false,
        contentType: false,
        success: res => {
          if (!res.success) {
            $('.import-wrapper').append(`<div class="row"><div class="col-md-12"><div class="alert alert-danger" role="alert">${res.message}<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div></div></div>`);
          } else {
            $('.loader').addClass('hidden');
            $('.import-result-container').addClass('active');
            $('.import-result').append(res.data);
            $('.import-wrapper').append(`<div class="row"><div class="col-md-12"><div class="alert alert-success" role="alert">${res.message}<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div></div></div>`);
          }
        },
        error: (xhr, ajaxOptions, thrownError) => {
          $('.loader').addClass('hidden');
          $('.import-wrapper').append(`<div class="row"><div class="col-md-12"><div class="alert alert-danger" role="alert">${thrownError}<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div></div></div>`);
        }
      });
    });

    $(this).on('click', '.import-result-print', function() {
      $('.import-result').print();
      return false;
    });
  });
</script>
@endsection