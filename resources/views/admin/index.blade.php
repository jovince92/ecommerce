@extends('admin.app')

@section('content')
<div class="container-full">

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xl-3 col-6">
                <div class="box overflow-hidden pull-up">
                    <div class="box-body">							
                        <div class="icon bg-primary-light rounded w-60 h-60">
                            <i class="text-primary mr-0 font-size-24 mdi mdi-account-multiple"></i>
                        </div>
                        <div>
                            <p class="text-mute mt-20 mb-0 font-size-16">New Customers this week</p>
                            <h3 class="text-white mb-0 font-weight-500">{{ count($newusersthisweek) }}<small class="text-success"><i class="fa fa-caret-up"></i> </small></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-6">
                <div class="box overflow-hidden pull-up">
                    <div class="box-body">							
                        <div class="icon bg-warning-light rounded w-60 h-60">
                            <i class="text-warning mr-0 font-size-24 mdi mdi-car"></i>
                        </div>
                        <div>
                            <p class="text-mute mt-20 mb-0 font-size-16">Today's sale</p>
                            <h3 class="text-white mb-0 font-weight-500">${{ $todaysale }}<small class="text-success"><i class="fa fa-caret-up"></i> USD</small></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-6">
                <div class="box overflow-hidden pull-up">
                    <div class="box-body">							
                        <div class="icon bg-info-light rounded w-60 h-60">
                            <i class="text-info mr-0 font-size-24 mdi mdi-sale"></i>
                        </div>
                        <div>
                            <p class="text-mute mt-20 mb-0 font-size-16">This month's sale </p>
                            <h3 class="text-white mb-0 font-weight-500">${{ $thismonthsale }} <small class="text-danger"><i class="fa fa-caret-down"></i> USD</small></h3>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-6">
                <div class="box overflow-hidden pull-up">
                    <div class="box-body">							
                        <div class="icon bg-success-light rounded w-60 h-60">
                            <i class="text-success mr-0 font-size-24 mdi mdi-phone-outgoing"></i>
                        </div>
                        <div>
                            <p class="text-mute mt-20 mb-0 font-size-16">Total products sold this month</p>
                            <h3 class="text-white mb-0 font-weight-500">{{ $productssoldthismonth }} <small class="text-success"><i class="fa fa-caret-up"></i> </small></h3>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="col-12">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title align-items-start flex-column">
                            Breakdown of orders:
                            <small class="subtitle"></small>
                        </h4>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table no-border">
                                <thead>
                                    <tr class="text-uppercase bg-lightest">
                                        <th style="min-width: 250px"><span class="text-white">Status</span></th>
                                        <th style="min-width: 100px"><span class="text-fade">Total Amount</span></th>
                                        <th style="min-width: 100px"><span class="text-fade">Total Products</span></th>
                                        <th style="min-width: 150px"><span class="text-fade">No. of Orders</span></th>                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders_summary as $summary)
                                        <tr>
                                            <td>
                                                <span class="badge badge-primary-light badge-lg">{{ $summary->status }}</span>
                                            </td>
                                            <td>
                                                @if (($summary->id>=7)&&($summary->id<=9))
                                                    <span class="text-danger font-weight-600 d-block font-size-16">-$ {{ number_format(0.00+$summary->totalamount,2,'.',',') }}</span>    
                                                @else
                                                    <span class="text-white font-weight-600 d-block font-size-16">$ {{ number_format(0.00+$summary->totalamount,2,'.',',') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="text-white font-weight-600 d-block font-size-16">{{ 0+$summary->totalproducts }}</span>
                                            </td>
                                            <td>
                                                <span class="text-white font-weight-600 d-block font-size-16">{{ 0+$summary->qty }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    
                                    
                                    
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection
