            </section>
        </section>
    </section>
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chartsjs/Chart.min.js"></script>
    <script src="assets/js/dashboard-charts.js"></script>
    <script src="assets/js/script.js"></script>
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/airdatepicker/js/datepicker.min.js"></script>
    <script src="assets/vendor/airdatepicker/js/i18n/datepicker.en.js"></script>
    <script src="assets/vendor/mdtimepicker/mdtimepicker.min.js"></script>
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/chartsjs/Chart.min.js"></script>
    <script src="../assets/js/dashboard-charts.js"></script>
    <script src="../assets/js/script.js"></script>
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/datatables/datatables.min.js"></script>
    <script src="../assets/js/initiate-datatables.js"></script>
    <script>
    const body = document.querySelector('body'),
    sidebar = body.querySelector('nav'),
    toggle = body.querySelector(".toggle"),
    modeSwitch = body.querySelector(".toggle-switch"),
    modeText = body.querySelector(".mode-text");


toggle.addEventListener("click" , () =>{
    sidebar.classList.toggle("close");
})
modeSwitch.addEventListener("click" , () =>{
    body.classList.toggle("dark");
    if(body.classList.contains("dark")){
        modeText.innerText = "Light mode";
    }else{
        modeText.innerText = "Dark mode";  
    }
});
    </script>
  </body>
</html>

<?php if(isset($db)) { $db->db_disconnect(); } ?>
