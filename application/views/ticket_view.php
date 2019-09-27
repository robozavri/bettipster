  <div class="col-md-3 col-sm-12">
      <div class="ticket">
        <h3><?php echo $this->lang->line('text_ticket');?></h3>
          <ul class="list-group matches ticket-list"></ul>
          <!-- <p class="coeficient-count">საერთო კოეფიციენტი :<span class="pull-right">45</span></p> -->
          <!-- <p class="ticket-fail-message">ამოგეწურათ დადების ლიმიტი</p> -->
          <!-- <p class="ticket-success-message">თქვენ წარმატებით გააკეთეთ პროგნოზი</p> -->
          <div class="ticket-message"></div>
          <button onclick="cancelTicket()" class="btn-cancel-marches"><?php echo $this->lang->line('text_cancel');?></button>
          <button onclick="sendMatch()" class="btn-send-matches"><?php echo $this->lang->line('text_send');?></button>
      </div>
    </div>