<div class="modal fade" id="cancelPopup">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cancel</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h6>Are you sure you want to cancel without saving ?</h6>
            </div>
            <div class="modal-footer">
                <a  id="link" class="std_butU btn btn-secondary">Yes</a>                   
                <button type="button" class="std_but1 btn btn-secondary" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
    $("#popup").click(function(){
        var url = $(this).data('id');
        document.querySelector('#link').setAttribute('href',url);
    });
    });
</script>
