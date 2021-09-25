@extends('admin.app')

@section('content')


  
  <!-- Content Wrapper. Contains page content -->
  
    <div class="container-full">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="d-flex align-items-center">
              <div class="mr-auto">
                  <h3 class="page-title">Cities Tables</h3>
                  
              </div>
          </div>
      </div>

      <!-- Main content -->
      <section class="content">
        <div class="row">
            
          

          

            

        <div class="col-8">

           <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Cities</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                    <div class="card">
                        <h5>Country: <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <select name="country" id=""  class="form-control">                                    
                                <option value="" selected disabled >Select Country</option>
                                @foreach ($countries as $country)                             
                                    <option value="{{ $country->id }}"  >{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <h5>State: <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <select name="state" id=""  class="form-control">                                                            
                                <option value="" selected disabled >Select State</option>
                            </select>
                        </div>
                    </div>

                  <div class="table-responsive">
                    <table  class="table table-bordered table-striped">
                      <thead>
                            <tr>                                
                                <th>Country </th>
                                <th>State</th>
                                <th>City Name</th>
                                <th>Delete</th>                              
                            </tr>
                      </thead>
                      <tbody id="cities_table">                          
                        
                          
                          
                      </tbody>
                      
                    </table>
                  </div>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->

            
        </div>
        <!-- /.col -->

        <div class="col-4">
            <div class="box">
                <div class="box-header with-border">
                    <h3>Add Cities</h3>
                </div>
                <div class="box-body">
                    <form method="POST" action="{{ route('cities.create') }}" >
                        @csrf      
                        <h6>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </h6>                    					
                        <div class="form-group">
                            {{-- <img src="" alt="" style="widthpx: 100; height: 100px;" id="categoryPic"> --}}
                            <h5>Select Country:<span class="text-danger">*</span></h5>
                            <div class="controls">                                
                                <select name="country2" id=""  class="form-control" required="">                                    
                                    <option value="" selected disabled >Select Country</option>
                                    @foreach ($countries as $country)                             
                                        <option value="{{ $country->id }}"  >{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <h5>Select State:<span class="text-danger">*</span></h5>
                            <div class="controls">                                
                                <select name="state2" id=""  class="form-control" required="">                                    
                                    <option value="" selected disabled >Select State</option>                                    
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <h5>City Name:<span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="city_name" class="form-control" required="" data-validation-required-message="This field is required" > 
                            </div>
                        </div>


                        
                        {{-- <div class="form-group">     
                            <h5>Category Icon<span class="text-danger">*</span></h5>                           
                            <div class="controls">
                                <input type="file" name="category_image" class="form-control"  id="image" >
                            </div>
                        </div> --}}
                        <div class="text-xs-right">
                            <button type="submit" class="btn btn-rounded btn-primary mb-5">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
    
    </div>


    <script>
        $(document).ready(function(){
            $('select[name="country"]').on('change',function (){
               
                var country_id=$(this).val();
                if(country_id){
                    $.ajax({
                        url: "{{ url('/admin/shipping/states/') }}/"+country_id,
                        type: "GET",
                        dataType:"json",
                        success:function(data){
                            var htm="";
                            $('select[name="state"]').empty();
                            
                            $('select[name="state"]').append('<option value="" selected disabled >Select State</option>');                              
                            $.each(data,function(key,value){
                                $('select[name="state"]').append('<option value ="'+value.id+'">'+value.name+'</option>');
                                console.log(value); 
                                
                                // $.each(value.city,function(key2,value2){
                                //     htm+=`
                                //     <tr>                                
                                //         <td>${value.country.name}</td>
                                //         <td>${value.name}</td>                                
                                //         <td>${value2.name}</td>                                
                                                                        
                                //         <td>
                                //             {{-- <form action=""> --}}
                                //                 <a href=""class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                                //                 <a href="" class="btn btn-danger btn-sm" id="delete" onclick="event.preventDefault();"><i class="fa fa-trash"></i></a>                                        
                                //             {{-- </form>                                     --}}
                                //         </td>
                                //     </tr>
                                //     `;                                
                                // $('#cities_table').html(htm);
                                // });

                            });
                        },
                        error: function(xhr){
                            alert( xhr.status + " " + xhr.statusText);
                        }
                    });
                }else{
                    alert('danger');
                }
                
            });
        });
    </script>


    <script>
        $(document).ready(function(){
            $('select[name="state"]').on('change',function (){
            
                var state_id=$(this).val();
                if(state_id){
                    $.ajax({
                        url: "{{ url('/admin/shipping/states_cities/') }}/"+state_id,
                        type: "GET",
                        dataType:"json",
                        success:function(data){
                            $('#cities_table').empty();
                            var htm="";
                            $.each(data,function(key,value){
                                $.each(value.city,function(key2,value2){
                                    var layer_id = value2.id;
                                    var url = '{{ route("cities.delete", ":id") }}';
                                    url = url.replace(':id', layer_id );
                                    htm+=`
                                        <tr>                                
                                            <td>${value.country.name}</td>
                                            <td>${value.name}</td>                                
                                            <td>${value2.name}</td>                                
                                                                            
                                            <td>
                                                {{-- <form action=""> --}}
                                                    
                                                    <a href="${url }" class="btn btn-danger btn-sm" id="delete" onclick="event.preventDefault();"><i class="fa fa-trash"></i></a>                                        
                                                {{-- </form>                                     --}}
                                            </td>
                                        </tr>
                                        `;
                                    console.log(value);
                                    $('#cities_table').html(htm);
                                });
                                
                            });
                        },
                        error: function(xhr){
                            alert( xhr.status + " " + xhr.statusText);
                        }
                    });
                }else{
                    alert('danger');
                }
                
            });
        });
    </script>



<script>
    $(document).ready(function(){
        $('select[name="country2"]').on('change',function (){
           
            var country_id=$(this).val();
            if(country_id){
                $.ajax({
                    url: "{{ url('/admin/shipping/states/') }}/"+country_id,
                    type: "GET",
                    dataType:"json",
                    success:function(data){
                        $('select[name="state2"]').empty();
                        $.each(data,function(key,value){
                            $('select[name="state2"]').append('<option value ="'+value.id+'">'+value.name+'</option>');
                            console.log(value);
                        });
                    },
                    error: function(xhr){
                        alert( xhr.status + " " + xhr.statusText);
                    }
                });
            }else{
                alert('danger');
            }
            
        });
    });
</script>



@endsection