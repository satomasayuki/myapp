<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<script type="text/javascript">alert("<?= $message ?>");</script>
<!--
<div class="message error" onclick="this.classList.add('hidden');"><?= $message ?></div>
-->