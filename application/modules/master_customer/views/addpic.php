<?php if (!empty($dataPIC)) {
        foreach ($dataPIC AS $data) {
?>
    <div class="form-group row">
        <label for="nm_pic" class="col-sm-2 control-label">PIC Name <font size="4" color="red"><B>*</B></font></label>
        <div class="col-sm-4">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-building"></i></span>
                <input type="text" class="form-control input-md" id="nm_pic" name="nm_pic[form][]" value="<?= $data->nm_pic ?>" maxlength="45" placeholder="PIC Name" autocomplete='off' required>
                <input type="hidden" class="form-control input-md" id="id_pic" name="id_pic[form][]" value="<?= $data->id_pic ?>" maxlength="45" placeholder="PIC ID" autocomplete='off' required>
            </div>
        </div>
        <label for="divisi" class="col-sm-2 control-label">Division <font size="4" color="red"><B>*</B></font></label>
        <div class="col-sm-4">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-building"></i></span>
                <input type="text" class="form-control" id="divisi" name="divisi[form][]" value="<?= $data->divisi ?>" maxlength="45" placeholder="Division" required autocomplete='off'>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="hp" class="col-sm-2 control-label">Contact Number <font size="4" color="red"><B>*</B></font></label>
        <div class="col-sm-4">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-building"></i></span>
                <input type="text" class="form-control" id="hp" name="hp[form][]" value="<?= $data->hp ?>" maxlength="15" placeholder="Contact Number" autocomplete='off' required>
            </div>
        </div>
        <label for="email_pic" class="col-sm-2 control-label">Email Address</label>
        <div class="col-sm-4">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input type="text" class="form-control" id="email_pic" name="email_pic[form][]" value="<?= $data->email_pic ?>" maxlength="45" placeholder="Email Address" autocomplete='off'>
            </div>
        </div>
    </div>
<?php
    }
} else {
?>
    <div class="form-group row">
        <label for="nm_pic" class="col-sm-2 control-label">PIC Name <font size="4" color="red"><B>*</B></font></label>
        <div class="col-sm-4">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-building"></i></span>
                <input type="text" class="form-control input-md" id="nm_pic" name="nm_pic[form][]" maxlength="45" placeholder="PIC Name" autocomplete='off' required>
            </div>
        </div>
        <label for="divisi" class="col-sm-2 control-label">Division <font size="4" color="red"><B>*</B></font></label>
        <div class="col-sm-4">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-building"></i></span>
                <input type="text" class="form-control" id="divisi" name="divisi[form][]" maxlength="45" placeholder="Division" required autocomplete='off'>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="hp" class="col-sm-2 control-label">Contact Number <font size="4" color="red"><B>*</B></font></label>
        <div class="col-sm-4">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-building"></i></span>
                <input type="text" class="form-control" id="hp" name="hp[form][]" maxlength="15" placeholder="Contact Number" autocomplete='off' required>
            </div>
        </div>
        <label for="email_pic" class="col-sm-2 control-label">Email Address</label>
        <div class="col-sm-4">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input type="text" class="form-control" id="email_pic" name="email_pic[form][]" maxlength="45" placeholder="Email Address" autocomplete='off'>
            </div>
        </div>
    </div>
<?php 
} ?>