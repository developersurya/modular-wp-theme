<?php 
/**
 * This file contains view part only (HTML)
 * #use var_dump($args); to check all available data
 * 
 */


 if (!empty($args)): 
//var_dump($args);  
//get the post_id 
$p_id = $args['p_id'];
if(!empty($args["data"])){
    //get the last and first from array
  $start_year = $args['data'][0]['date_array']['2'];
  $end_year =  $args['data'][count($args['data']) - 1]['date_array']['2'];

?>
<div class="xcontainer">
     <div class="search-ajax-wrp  tablesorter table table-hover">
        <div class="xrow">
            <!--new sm search ajax-->
            <div class="search-ajax-title">Check Availabile Dates:</div>
            <div class="search-ajax-wrp">
                <div class="search-ajax-year">
                    <select id="search-ajax-year" class="">
                        <option value="yearlist0">Select Year</option>
                         <?php  
                            //check the starting date/ending date and loop it 
                            $x = (int)$start_year; 
                            $y = (int)$end_year;
                            while($x <= $y) {?>
                                <option value="yearlist<?php echo $x;?>"><?php echo $x;?></option>
                            <?php $x++;
                            }  ?>
                    </select>
                </div>
            
                <div class="search-ajax-month">
                    <select id="search-ajax-month" class="">
                    <option value="monthlist0">Select Month</option>
                    <option value="monthlist1">Jan</option>
                    <option value="monthlist2">Feb</option>
                    <option value="monthlist3">Mar</option>
                    <option value="monthlist4">Apr</option>
                    <option value="monthlist5">May</option>
                    <option value="monthlist6">Jun</option>
                    <option value="monthlist7">Jul</option>
                    <option value="monthlist8">Aug</option>
                    <option value="monthlist9">Sep</option>
                    <option value="monthlist10">Oct</option>
                    <option value="monthlist11">Nov</option>
                    <option value="monthlist12">Dec</option>
                    </select>
                </div>
            <?php if(isset($args['group_data'])){
                $group_data = $args['group_data'];
                ?>
            <div class="search-ajax-month">
                <select id="search-ajax-group" class="">
                    <option value="0">Group discount available</option>
                    <?php foreach ( $group_data as $groupdata ){?>
                    <option value="<?php echo $groupdata['group_range'];?>"><?php echo $groupdata['group_range'];?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="search-ajax-month">
                <button class="btn-warning reset-btn">Reset</button>
            </div>
            <?php } ?>
            </div>
        </div>
            <!--/new sm search ajax-->
    <div class="departure-pid" style="display:none;"><?php echo $p_id;?></div>
    <div class="departure-result-table">
    <div id="custom-scroller">
    <div class="date-list">
    <div class="overlay-table" style="display: none;position:relative;"><div class="searching">Searching <div class="lds-facebook"><div></div><div></div><div></div></div></div></div>
        <table id="booking-dates" class="table  table-hover">
            <thead class="thead-light">
                <tr class="active">
                    <!-- <th scope="col">#</th> -->
                    <th scope="col">Date (Start - End)</th>
                    <th scope="col">Price (Per Person)</th>
                    <!-- <th scope="col">Discount</th>
                    <th scope="col">Status</th> -->
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody id="update">
            
                 <?php 
                 if (!empty($args['data'])) { 
                    $count=1;
                    $pax = false;
                     foreach($args['data'] as $data) {
                        ?>
                        <tr data-year="<?php echo trim($data['date_array']['2']);?>" data-month="<?php echo $data['date_array']['0'];?>">
                            <!-- <th scope="row"><?php //echo $count;?></th> -->
                            <td><?php echo $data['start_date__end_date'];?></td>
                            <td><?php echo "USD <del>".$data['price']."</del> ";?> 
                            <?php echo $data['discounted_price'];?></td>
                            <!-- <td><?php //echo $data['discount'].'%';?></td>
                            <td><?php //echo $data['status'];?></td> -->
                            <td><button type="button" class="btn btn-secondary"><a href="<?php echo site_url().'/trip-booking/?tid='.get_the_ID().'&dt='.$data['start_date__end_date'].'&px='.$pax;?>">Book Now</a></button>
                            </td>
                        </tr>
                 <?php
                 $count++;
                    }
                    }
                   
                ?>
                
            </tbody>
           
        </table>

        </div>
        </div>
       
    </div>
</div>
<?php }
endif;?>

