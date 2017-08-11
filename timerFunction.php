<?php
function countDown($time) {
	?>
	<script type="text/javascript">
        function startTimer(duration, display) {
            var timer = duration, minutes, seconds;
            setInterval(function () {
                minutes = parseInt(timer / 60, 10)
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                if(minutes > 0) {
                    display.textContent = minutes + ":" + seconds;
                }else{
                    display.textContent = seconds;
                }

                if (--timer < 0) {
                    timer = duration;
                }
            }, 1000);
        }

        window.onload = function () {
            startTimer(<?= $time ?>, document.querySelector('#time'));
        };
	</script>
	<?php
}