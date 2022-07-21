<script src="assets/plugins/jquery.min.js"></script>
<script>
    const baseurl = "<?=base_url()?>";
    const localStrings = {
        'name-surname-error': '<?=$thisController->footerMessage[0]->ct_titles[2]->title?>',
        'email-error': '<?=$thisController->footerMessage[0]->ct_titles[4]->title?>',
        'phone-error': '<?=$thisController->footerMessage[0]->ct_titles[6]->title?>',
        'message-error': '<?=$thisController->footerMessage[0]->ct_titles[8]->title?>',
    };
</script>
<script type="text/javascript" src="assets/plugins/slick/slick.min.js"></script>
<script type="text/javascript" src="assets/scripts/main.js?v=<?=CJ_VERSION?>"></script>

</body>
</html>
