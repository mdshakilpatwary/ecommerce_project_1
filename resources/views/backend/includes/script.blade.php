  <?php
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
        $all_permissions  = Permission::all();
        $permission_groups = User::getpermissionGroups();
  ?>
  <!-- jquery  Scripts -->
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-json/2.6.0/jquery.json.min.js" integrity="sha512-QE2PMnVCunVgNeqNsmX6XX8mhHW+OnEhUhAWxlZT0o6GFBJfGRCfJ/Ut3HGnVKAxt8cArm7sEqhq2QdSF0R7VQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- General JS Scripts -->
  <script src="{{asset('backend')}}/assets/js/app.min.js"></script>
  <!-- JS data table -->
  <script src="{{asset('backend')}}/assets/bundles/datatables/datatables.min.js"></script>
  <script src="{{asset('backend')}}/assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="{{asset('backend')}}/assets/bundles/jquery-ui/jquery-ui.min.js"></script>
  <script src="{{asset('backend')}}/assets/js/page/datatables.js"></script>
  <!-- JS Libraies -->
  <script src="{{asset('backend')}}/assets/bundles/apexcharts/apexcharts.min.js"></script>
  <!-- Page Specific JS File -->
  <script src="{{asset('backend')}}/assets/js/page/index.js"></script>
  <!-- Template JS File -->
  <script src="{{asset('backend')}}/assets/js/scripts.js"></script>
  <!-- jquery plugin JS File -->
  <script src="{{asset('backend')}}/assets/bundles/ckeditor/ckeditor.js"></script>
  <script src="{{asset('backend')}}/assets/bundles/summernote/summernote-bs4.js"></script>




  <script src="{{asset('backend')}}/assets/js/jQuery.tagify.min.js"></script>
  <script src="{{asset('backend')}}/assets/js/tagify.js"></script>

  <!-- Custom JS File -->

  <script src="{{asset('backend')}}/assets/js/custom.js"></script>
  <script src="{{asset('backend')}}/assets/js/filter-multi-select-bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
  <script src="{{asset('backend')}}/assets/bundles/datatables/export-tables/jszip.min.js"></script>
  <script src="{{asset('backend')}}/assets/bundles/datatables/export-tables/pdfmake.min.js"></script>
  <script src="{{asset('backend')}}/assets/bundles/datatables/export-tables/vfs_fonts.js"></script>
  <script src="{{asset('backend')}}/assets/bundles/datatables/export-tables/buttons.print.min.js"></script>
  
  <script>
    const product_colors = $('#product-colors').filterMultiSelect();
  </script>
  <script>
    const product_sizes_1 = $('#product-sizes-1').filterMultiSelect();
  </script>
  <script>
    const product_sizes_2 = $('#product-sizes-2').filterMultiSelect();
  </script>
  <script>
    const role_permission = $('#permission').filterMultiSelect();
  </script>

    {{-- role and permission  --}}


<script>
  /**
       * Check all the permissions
       */
       $("#checkPermissionAll").click(function(){
           if($(this).is(':checked')){
               // check all the checkbox
               $('input[type=checkbox]').prop('checked', true);
           }else{
               // un check all the checkbox
               $('input[type=checkbox]').prop('checked', false);
           }
       });

       function checkPermissionByGroup(className, checkThis){
          const groupIdName = $("#"+checkThis.id);
          const classCheckBox = $('.'+className+' input');

          if(groupIdName.is(':checked')){
               classCheckBox.prop('checked', true);
           }else{
               classCheckBox.prop('checked', false);
           }
          implementAllChecked();
       }

       function checkSinglePermission(groupClassName, groupID, countTotalPermission) {
          const classCheckbox = $('.'+groupClassName+ ' input');
          const groupIDCheckBox = $("#"+groupID);

          // if there is any occurance where something is not selected then make selected = false
          if($('.'+groupClassName+ ' input:checked').length == countTotalPermission){
              groupIDCheckBox.prop('checked', true);
          }else{
              groupIDCheckBox.prop('checked', false);
          }
          implementAllChecked();
       }

       function implementAllChecked() {
           const countPermissions = {{ count($all_permissions) }};
           const countPermissionGroups = {{ count($permission_groups) }};

          //  console.log((countPermissions + countPermissionGroups));
          //  console.log($('input[type="checkbox"]:checked').length);

           if($('input[type="checkbox"]:checked').length >= (countPermissions + countPermissionGroups)){
              $("#checkPermissionAll").prop('checked', true);
          }else{
              $("#checkPermissionAll").prop('checked', false);
          }
       }


</script>


</body>


<!-- index.html  21 Nov 2019 03:47:04 GMT -->
</html>