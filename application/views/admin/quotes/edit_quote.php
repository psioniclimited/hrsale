<?php
// Edit Quote Page

$system_setting = $this->Xin_model->read_setting_info(1);
?>
<?php $session = $this->session->userdata('username');?>
<?php $get_animate = $this->Xin_model->get_content_animate();?>
<?php $user_info = $this->Xin_model->read_user_info($session['user_id']);?>

<div class="row <?php echo $get_animate;?>">
  <div class="col-md-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title"> Edit Quote #<?php echo $quote_number;?> </h3>
      </div>
      <div class="box-body" aria-expanded="true" style="">
        <div class="row m-b-1">
          <div class="col-md-12">
            <?php $attributes = array('name' => 'create_invoice', 'id' => 'xin-form', 'autocomplete' => 'off', 'class' => 'form');?>
            <?php $hidden = array('user_id' => 0);?>
            <?php echo form_open('admin/quotes/update_quote/'.$quote_id, $attributes, $hidden);?>
            <div class="bg-white">
              <div class="box-block">
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="quote_number"><?php echo $this->lang->line('xin_title_quote_number');?></label>
                      <input class="form-control" placeholder="<?php echo $this->lang->line('xin_title_quote_number');?>" name="quote_number" type="text" readonly="readonly" value="<?php echo $quote_number;?>">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="xin_title"><?php echo $this->lang->line('xin_project_title');?></label>
                      <input class="form-control" placeholder="<?php echo $this->lang->line('xin_project_title');?>" name="xin_title" type="text" value="<?php echo $xin_title;?>">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="quote_date"><?php echo $this->lang->line('xin_quote_date');?></label>
                      <input class="form-control date" placeholder="<?php echo $this->lang->line('xin_quote_date');?>" readonly="readonly" name="quote_date" type="text" value="<?php echo $quote_date;?>">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="quote_due_date"><?php echo $this->lang->line('xin_project_start_date');?></label>
                      <input class="form-control date" placeholder="<?php echo $this->lang->line('xin_project_start_date');?>" readonly="readonly" name="quote_due_date" type="text" value="<?php echo $quote_due_date;?>">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="client_id"><?php echo $this->lang->line('module_company_title');?></label>
                      <select name="client_id" id="client_id" class="form-control" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('module_company_title');?>">
                        <option value=""></option>
                        <?php foreach($all_clients as $client) {?>
                        <option value="<?php echo $client->client_id;?>" <?php if($eclient_id == $client->client_id):?> selected="selected"<?php endif;?>> <?php echo $client->company_name;?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <?php if($user_info[0]->user_role_id==1){ ?>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="company_id"><?php echo $this->lang->line('left_organization');?></label>
                      <select name="company_id" id="aj_company" class="form-control" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('left_organization');?>">
                        <option value=""></option>
                        <?php foreach($all_companies as $company) {?>
                        <option value="<?php echo $company->company_id;?>" <?php if($ecompany_id == $company->company_id):?> selected="selected"<?php endif;?>> <?php echo $company->name;?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <?php } else {?>
                  <?php $ecompany_id = $user_info[0]->company_id;?>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="company_id"><?php echo $this->lang->line('left_organization');?></label>
                      <select name="company_id" id="aj_company" class="form-control" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('left_organization');?>">
                        <option value=""></option>
                        <?php foreach($all_companies as $company) {?>
                        <?php if($ecompany_id == $company->company_id):?>
                        <option value="<?php echo $company->company_id;?>" <?php if($ecompany_id == $company->company_id):?> selected="selected"<?php endif;?>> <?php echo $company->name;?></option>
                        <?php endif;?>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <?php } ?>
                  <?php $result = $this->Department_model->ajax_company_employee_info($ecompany_id);?>
                  <div class="col-md-3">
                    <div class="form-group" id="employee_ajax">
                      <label for="project_manager"><?php echo $this->lang->line('xin_project_manager_title');?></label>
                      <select name="project_manager" id="project_manager" class="form-control select-border-color border-warning" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('xin_project_manager_title');?>">
                        <?php foreach($result as $employee) {?>
                        <option value="<?php echo $employee->user_id;?>" <?php if($project_manager == $employee->user_id):?> selected="selected"<?php endif;?>> <?php echo $employee->first_name.' '.$employee->last_name;?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group" id="cemployee_ajax">
                      <label for="employee"><?php echo $this->lang->line('xin_project_coordinator');?></label>
                      <select name="project_coordinator" id="project_coordinator" class="form-control select-border-color border-warning" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('xin_project_coordinator');?>">
                        <?php foreach($result as $employee) {?>
                        <option value="<?php echo $employee->user_id;?>" <?php if($project_coordinator == $employee->user_id):?> selected="selected"<?php endif;?>> <?php echo $employee->first_name.' '.$employee->last_name;?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                <div class="col-md-3">
                    <div class="form-group" id="cemployee_ajax">
                      <label for="quote_type"><?php echo $this->lang->line('xin_quote_type');?></label>
                      <select name="quote_type" id="quote_type" class="form-control select-border-color border-warning" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('xin_quote_type');?>">
                        <option value="bid" <?php if($quote_type == 'bid'):?> selected="selected"<?php endif;?>><?php echo $this->lang->line('xin_quote_type_bid');?></option>
                        <option value="tm" <?php if($quote_type == 'tm'):?> selected="selected"<?php endif;?>><?php echo $this->lang->line('xin_quote_type_tm');?></option>
                      </select>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <div class="hrsale-item-values">
                        <div data-repeater-list="items">
                          <div data-repeater-item="">
                            <?php $prod = array(); foreach($this->Quotes_model->get_quote_items($quote_id) as $_item):?>
                            <div class="row item-row">
                              <div class="form-group mb-1 col-sm-12 col-md-6">
                                <input type="hidden" name="item[<?php echo $_item->quote_item_id;?>]" value="<?php echo $_item->quote_item_id;?>" />
                                <label for="item_name">Item</label>
                                <br>
                                <input type="text" class="form-control item_name" name="eitem_name[<?php echo $_item->quote_item_id;?>]" id="item_name" placeholder="Item Name" value="<?php echo htmlentities($_item->item_name);?><?php //echo $_item->item_name;?>">
                              </div>
                              <div class="form-group mb-1 col-sm-12 col-md-1">
                                <label for="qty_hrs" class="cursor-pointer">Qty/Hrs</label>
                                <br>
                                <input type="text" class="form-control qty_hrs" name="eqty_hrs[<?php echo $_item->quote_item_id;?>]" id="qty_hrs" value="<?php echo $_item->item_qty;?>">
                              </div>
                              <div class="skin skin-flat form-group mb-1 col-sm-12 col-md-2">
                                <label for="unit_price">Unit Price</label>
                                <br>
                                <input class="form-control unit_price" type="text" name="eunit_price[<?php echo $_item->quote_item_id;?>]" value="<?php echo $_item->item_unit_price;?>" id="unit_price" />
                              </div>
                              <div class="form-group mb-1 col-sm-12 col-md-2">
                                <label for="profession">Subtotal</label>
                                <input type="text" class="form-control sub-total-item" readonly="readonly" name="esub_total_item[<?php echo $_item->quote_item_id;?>]" value="<?php echo $_item->item_sub_total;?>" />
                                <!-- <br>-->
                                <p style="display:none" class="form-control-static"><span class="amount-html">0</span></p>
                              </div>
                              <div class="form-group col-sm-12 col-md-1 text-xs-center mt-2">
                                <label for="profession">&nbsp;</label>
                                <br>
                                <button type="button" class="btn icon-btn btn-xs btn-danger waves-effect waves-light eremove-item" data-repeater-delete="" data-record-id="<?php echo $_item->quote_item_id;?>" data-invoice-id="<?php echo $quote_id;?>"> <span class="fa fa-trash"></span></button>
                              </div>
                            </div>
                            <?php endforeach;?>
                          </div>
                        </div>
                      </div>
                      <div id="item-list"></div>
                      <div class="form-group overflow-hidden1">
                        <div class="col-xs-12">
                          <button type="button" data-repeater-create="" class="btn btn-primary" id="add-invoice-item"> <i class="fa fa-plus"></i> Add Item</button>
                        </div>
                      </div>
                      <?php
						$ar_sc = explode('- ',$system_setting[0]->default_currency_symbol);
						$sc_show = $ar_sc[1];
						?>
                      <input type="hidden" class="items-sub-total" name="items_sub_total" value="<?php echo $sub_total_amount;?>" />
                      <input type="hidden" class="items-tax-total" name="items_tax_total" value="<?php echo $total_tax;?>" />
                      <div class="row">
                        <div class="col-md-7 col-sm-12 text-xs-center text-md-left">&nbsp; </div>
                        <div class="col-md-5 col-sm-12">
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <td>Sub Total</td>
                                  <td class="text-xs-right"><?php echo $sc_show;?> <span class="sub_total"><?php echo $sub_total_amount;?></span></td>
                                </tr>
                                <tr>
                                  <td colspan="2" style="border-bottom:1px solid #dddddd; padding:0px !important; text-align:left"><table class="table table-bordered">
                                      <tbody>
                                        <tr>
                                         <!-- <td width="30%" style="border-bottom:1px solid #dddddd; text-align:left"><strong>Tax Type</strong></td>-->
                                          <td colspan="3" align="left" style="border-bottom:1px solid #dddddd;"><strong>Tax</strong></td>
                                          <!--<td style="border-bottom:1px solid #dddddd; text-align:left"><strong>Tax Amount</strong></td>-->
                                        </tr>
                                        <tr>
                                          <!--<td><div class="form-group">
                                              <select name="tax_type" class="form-control tax_type">
                                                <option value="1"<?php if($tax_type==1):?> selected="selected"<?php endif;?>> Flat</option>
                                                <option value="2"<?php if($tax_type==2):?> selected="selected"<?php endif;?>> Percent</option>
                                              </select>
                                            </div></td>-->
                                          <td align="left" colspan="3"><div class="form-group">
                                              <input type="hidden" name="tax_type" class="form-control tax_type" value="1" />
                                              <input type="hidden" name="tax_amount" class="form-control tax_amount" value="0" />
                                              <input style="text-align:right;width:105px;" type="text" name="tax_figure" class="form-control tax_figure" value="<?php echo $total_tax;?>" data-valid-num="required">
                                            </div></td>
                                          <!--<td align="right"><div class="form-group">
                                              <input type="text" style="text-align:right" readonly="" name="tax_amount" value="<?php echo $total_tax;?>" class="tax_amount form-control">
                                            </div></td>-->
                                        </tr>
                                      </tbody>
                                    </table></td>
                                </tr>
                                <tr>
                                  <td colspan="2" style="border-bottom:1px solid #dddddd; padding:0px !important; text-align:left"><table class="table table-bordered">
                                      <tbody>
                                        <tr>
                                          <td width="30%" style="border-bottom:1px solid #dddddd; text-align:left"><strong>Discount Type</strong></td>
                                          <td style="border-bottom:1px solid #dddddd; text-align:center"><strong>Discount</strong></td>
                                          <td style="border-bottom:1px solid #dddddd; text-align:left"><strong>Discount Amount</strong></td>
                                        </tr>
                                        <tr>
                                          <td><div class="form-group">
                                              <select name="discount_type" class="form-control discount_type">
                                                <option value="1" <?php if($discount_type==1):?> selected="selected"<?php endif;?>> Flat</option>
                                                <option value="2" <?php if($discount_type==2):?> selected="selected"<?php endif;?>> Percent</option>
                                              </select>
                                            </div></td>
                                          <td align="right"><div class="form-group">
                                              <input type="hidden" name="tax_type" class="form-control tax_type" value="1" />
                                              <input style="text-align:right" type="text" name="discount_figure" class="form-control discount_figure" value="<?php echo $discount_figure;?>" data-valid-num="required">
                                            </div></td>
                                          <td align="right"><div class="form-group">
                                              <input type="text" style="text-align:right" readonly="" name="discount_amount" value="<?php echo $total_discount;?>" class="discount_amount form-control">
                                            </div></td>
                                        </tr>
                                      </tbody>
                                    </table></td>
                                </tr>
                              <input type="hidden" class="fgrand_total" name="fgrand_total" value="<?php echo $grand_total;?>" />
                              <tr>
                                <td>Grand Total</td>
                                <td class="text-xs-right"><?php echo $sc_show;?> <span class="grand_total"><?php echo $grand_total;?></span></td>
                              </tr>
                                </tbody>
                              
                            </table>
                          </div>
                        </div>
                      </div>
                      <div class="form-group col-xs-12 mb-2 file-repeaters"> </div>
                      <div class="row">
                        <div class="col-lg-12">
                          <label for="quote_note"><?php echo $this->lang->line('xin_quote_note');?></label>
                          <textarea name="quote_note" class="form-control"><?php echo $quote_note;?></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row no-print">
                  <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary pull-right print-invoice" name="invoice_submit" style="margin-right: 5px;"> <i class="fa fa fa-check-square-o"></i> Submit Quote </button>
                  </div>
                </div>
              </div>
            </div>
            <?php echo form_close(); ?> </div>
        </div>
      </div>
    </div>
  </div>
</div>
