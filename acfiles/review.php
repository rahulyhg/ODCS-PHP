
<script type="text/javascript">
    $(document).ready(function(){
        //  Check Radio-box
        $(".rating input:radio").attr("checked", false);
        $('.rating input').click(function () {
            $(".rating span").removeClass('checked');
            $(this).parent().addClass('checked');
        });

        $('input:radio').change(
            function(){
                var userRating = this.value;
                alert(userRating);
            });
    });
</script>

<div class="rating">
    <span><input type="radio" name="rating" id="str5" value="5"><label for="str5"></label>1</span>
    <span><input type="radio" name="rating" id="str4" value="4"><label for="str4"></label>2</span>
    <span><input type="radio" name="rating" id="str3" value="3"><label for="str3"></label>3</span>
    <span><input type="radio" name="rating" id="str2" value="2"><label for="str2"></label>4</span>
    <span><input type="radio" name="rating" id="str1" value="1"><label for="str1"></label>5</span>
</div>

<style>
    }
</style>
