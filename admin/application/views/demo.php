<div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="Image">Product Name
                                        <span style="color:red;">*</span></label> <span style="color:red" id="errorproduct_name"><?php echo form_error('product_name')?> </span>
                                    <select name="product_id" id="product_id" class="form-control" onchange="return getproduct(this.value);"><!-- onchange="return getBranch(this.value)" -->
                                            <option value="">Select Product</option>
                                            <!-- <?php if(!empty($countries)){ foreach ($countries as $country) {?>
                                                <option value="<?= $country->id; ?>" <?php if ($country_id==$country->id) { echo "selected";
                                                }?>><?= $country->country_name; ?></option>
                                            <?php }} ?>
 -->                                        </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="Image">HSN Code</label>
                                    <input type="text" placeholder="HSN Code" class="form-control" id="hsn_code" name="hsn_code" value="<?php //echo $hsn_code; ?>"readonly>
                                </div>
                                
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="Image">Manufacturing Date</label>
                                    <input type="text" placeholder="Manufacturing Date" class="form-control" id="mfg_date" name="mfg_date" value="<?php //echo $mfg_date; ?>"readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="Image">Expiry Date</label>
                                    <input type="text" placeholder="Expiry Date" class="form-control" id="expiry_date" name="expiry_date" value="<?php //echo $expiry_date; ?>"readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="Image">Quantity
                                        <span style="color:red;">*</span></label> <span style="color:red" id="errorquantity"> <?php echo form_error('quantity')?> </span>
                                    <input type="text" placeholder="Quantity" class="form-control" id="quantity" name="quantity" value="<?php //echo $quantity; ?>" onkeypress="only_number(event)" maxlength="4">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="Image">Unit
                                        <span style="color:red;">*</span></label> <span style="color:red" id="errorunit"> <?php echo form_error('unit')?> </span>
                                    <select name="unit" id="unit" class="form-control" onchange="return getunits(this.value);"><!-- onchange="return getBranch(this.value)" -->
                                            <option value="">Select Units</option>
                                            <!-- <?php if(!empty($countries)){ foreach ($countries as $country) {?>
                                                <option value="<?= $country->id; ?>" <?php if ($country_id==$country->id) { echo "selected";
                                                }?>><?= $country->country_name; ?></option>
                                            <?php }} ?>
 -->                                        </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="Image">Rate
                                        <span style="color:red;">*</span></label> <span style="color:red" id="errorrate"> <?php echo form_error('rate')?> </span>
                                    <input type="text" placeholder="Rate per Quantity" class="form-control" id="rate" name="rate" value="<?php //echo $rate; ?>" onkeypress="only_number(event)" maxlength="10">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="Image">CGST</label>
                                    <input type="text" placeholder="CGST" class="form-control" id="cgst" name="cgst" value="<?php //echo $cgst; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="Image">SGST</label>
                                    <input type="text" placeholder="SGST" class="form-control" id="sgst" name="sgst" value="<?php //echo $sgst; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="Image">IGST</label>
                                    <input type="text" placeholder="IGST" class="form-control" id="pin_code" name="igst" value="<?php //echo $igst; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="Image">Discount
                                        <span style="color:red;">*</span></label> <span style="color:red" id="errordiscount"><?php echo form_error('discount')?> </span>
                                    <input type="text" placeholder="Discount" class="form-control" id="discount" name="discount" value="<?php //echo $discount; ?>" onkeypress="only_number(event)" maxlength="6">
                                </div>
                            </div>
                            
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="Image">Total Price
                                        <span style="color:red;">*</span></label>
                                    <input type="text" placeholder="Total Price" class="form-control" id="total_price" name="total_price" value="<?php //echo $total_price; ?>" readonly>
                                </div>
                            </div>
                        </div>