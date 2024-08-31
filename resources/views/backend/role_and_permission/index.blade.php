@extends('backend.master')

@section('maincontent')
<div class="row mt-2">
@if(session('success'))

<div class="container alertsuccess">
<div class="alert alert-success alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        {{ session('success')}}
                      </div>
 </div>
</div>
@elseif(session('error'))
<div class="container alerterror">
<div class="alert alert-success alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        {{ session('error')}}
                      </div>
 </div>
</div>

@endif
<div class="col-md-12 pb-5">    
  <h2>Add Role and Permision </h2>
</div>
    <div class="col-md-6 offset-md-3  rounded py-3" style="background: #fff; box-shadow: 0 0 8px #ddd">        
        <form action="{{route('role.permission.store')}}" method="POST" >
            @csrf
            <div class="form-group ">
                <label for="name">Role Name</label>
                <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="Enter role name">


              @error('name') 
                    <p class="text-danger ">{{$message}}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="permissions">Permissions</label>

                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="checkPermissionAll" value="1" >
                    <label class="form-check-label" for="checkPermissionAll">All</label>
                    @error('permissions') 
                    <p class="text-danger ">{{$message}}</p>
                @enderror
                </div>
                <hr>
                @php $i = 1; @endphp
                @foreach ($permission_groups as $group)
                    <div class="row">
                        @php
                            $permissions = App\Models\User::getpermissionsByGroupName($group->name);
                            $j = 1;
                        @endphp
                        
                        <div class="col-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="{{ $i }}Management" value="{{ $group->name }}" onclick="checkPermissionByGroup('role-{{ $i }}-management-checkbox', this)" >
                                <label class="form-check-label" for="{{ $i }}Management">{{ $group->name }}</label>
                            </div>
                        </div>

                        <div class="col-9 role-{{ $i }}-management-checkbox">
                           
                            @foreach ($permissions as $permission)
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" onclick="checkSinglePermission('role-{{ $i }}-management-checkbox', '{{ $i }}Management', {{ count($permissions) }})" name="permissions[]"  id="checkPermission{{ $permission->id }}" value="{{ $permission->name }}">
                                    <label class="form-check-label" for="checkPermission{{ $permission->id }}">{{ $permission->name }}</label>
                                </div>
                                @php  $j++; @endphp
                            @endforeach
                            <br>
                        </div>

                    </div>
                    @php  $i++; @endphp
                @endforeach
            </div>

            
            <button class="btn btn-lg btn-success">Submit</button>
        </form>
    </div>
    
</div>

@endsection

@section('role_and_parmission_js')
<!-- role and permision js start  -->

<script>
    const role_permission = $('#permission').filterMultiSelect();
  </script>
<script>
  /**
       * Checked all  permissions
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
    
@endsection