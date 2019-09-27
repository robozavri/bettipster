<select class="form-control" onchange="javascript:window.location.href='Language/change/'+this.value;">
    <option value="english" <?php if($this->session->userdata('language') == 'english') echo 'selected="selected"'; ?>>English</option>
    <option value="georgian" <?php if($this->session->userdata('language') == 'georgian') echo 'selected="selected"'; ?>>georgian</option>
</select>
<p><?php echo $this->lang->line('welcome_message'); ?></p>
