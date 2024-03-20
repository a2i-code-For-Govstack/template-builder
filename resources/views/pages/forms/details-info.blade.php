<!-- Custom CSS -->

<div id="mySidebar1" class="sidebar1" style="margin-top:80px;">
    <div class="d-flex justify-content-end" style="margin-top:-20px;">
        <a class="text-black font-weight-bold text-xg" href="#" onclick="toggleSidebar1()">&times;</a>
    </div>


    <div style="margin-bottom:100px;">
        <div class="card mx-3 shadow-sm rounded m-1">
            <h6 class="pt-2 pl-2"><button value="@{{currentDate}}" class="btn btn-sm btn-primary mb-2 getInstructionValue">currentDate</button> : [Ex: 29-09-2023]</h6>
        </div>
        <div class="card mx-3 shadow-sm rounded m-1">
            <h6 class="pt-2 pl-2"><button value="@{{currentDateEn}}" class="btn btn-sm btn-primary mb-2 getInstructionValue">currentDateEn</button> : [Ex: 29-09-2023]</h6>
        </div>
        <div class="card mx-3 shadow-sm rounded m-1">
            <h6 class="pt-2 pl-2"><button value="@{{currentDateEnMonth}}" class="btn btn-sm btn-primary mb-2 getInstructionValue">currentDateEnMonth</button> : [Ex: 29-September-2023]</h6>
        </div>
        <div class="card mx-3 shadow-sm rounded m-1">
            <h6 class="pt-2 pl-2"><button value="@{{currentDateEnBn}}" class="btn btn-sm btn-primary mb-2 getInstructionValue">currentDateEnBn</button> : [Ex: ২৯-০৯-২০২৩]</h6>
        </div>
        <div class="card mx-3 shadow-sm rounded m-1">
            <h6 class="pt-2 pl-2"><button value="@{{currentDateEnBnMonth}}" class="btn btn-sm btn-primary mb-2 getInstructionValue">currentDateEnBnMonth</button> : [Ex: ২৯-সেপ্টেম্বর-২০২৩]</h6>
        </div>
        <div class="card mx-3 shadow-sm rounded m-1">
            <h6 class="pt-2 pl-2"> <button value="@{{currentDateBn}}" class="btn btn-sm btn-primary mb-2 getInstructionValue">currentDateBn</button> : [Ex: ১২-শ্রাবণ-১৪২৩]</h6>
        </div>
        <div class="card mx-3 shadow-sm rounded m-1">
            <h6 class="pt-2 pl-2"> <button value="@{{Recipient}}" class="btn btn-sm btn-primary mb-2 getInstructionValue">Recipient</button> : প্রাপক</h6>
        </div>
        <div class="card mx-3 shadow-sm rounded m-1">
            <h6 class="pt-2 pl-2"><button value="@{{Attention}}" class="btn btn-sm btn-primary mb-2 getInstructionValue">Attention</button> : দৃষ্টি আকর্ষণ</h6>
        </div>
        <div class="card mx-3 shadow-sm rounded m-1">
            <h6 class="pt-2 pl-2"><button value="@{{Sender}}" class="btn btn-sm btn-primary mb-2 getInstructionValue">Sender</button> : প্রেরক </h6>
        </div>

        <div class="card mx-3 shadow-sm rounded m-1">
            <h6 class="pt-2 pl-2"> <button value="@{{Approver}}" class="btn btn-sm btn-primary mb-2 getInstructionValue">Approver</button> </h6>
        </div>
        <div class="card mx-3 shadow-sm rounded m-1">
            <h6 class="pt-2 pl-2"> <button value="@{{Copier}}" class="btn btn-sm btn-primary mb-2 getInstructionValue">Copier</button></h6>
        </div>
        <div class="card mx-3 shadow-sm rounded m-1">
            <h6 class="pt-2 pl-2"> <button value="@{{MinistryName}}" class="btn btn-sm btn-primary mb-2 getInstructionValue">MinistryName</button></h6>
        </div>
        <div class="card mx-3 shadow-sm rounded m-1">
            <h6 class="pt-2 pl-2"> <button value="@{{OfficeName}}" class="btn btn-sm btn-primary mb-2 getInstructionValue">OfficeName</button></h6>
        </div>
        <div class="card mx-3 shadow-sm rounded m-1">
            <h6 class="pt-2 pl-2"> <button value="@{{OfficeAddress}}" class="btn btn-sm btn-primary mb-2 getInstructionValue">OfficeAddress</button></h6>
        </div>
        <div class="card mx-3 shadow-sm rounded m-1">
            <h6 class="pt-2 pl-2"> <button value="@{{OfficeBranch}}" class="btn btn-sm btn-primary mb-2 getInstructionValue">OfficeBranch </button></h6>
        </div>
        <div class="card mx-3 shadow-sm rounded m-1">
            <h6 class="pt-2 pl-2"> <button value="@{{OfficeWebSite}}" class="btn btn-sm btn-primary mb-2 getInstructionValue">OfficeWebSite </button></h6>
        </div>
        <div class="card mx-3 shadow-sm rounded m-1">
            <h6 class="pt-2 pl-2"> <button value="@{{currentMonthEn}}" class="btn btn-sm btn-primary mb-2 getInstructionValue">currentMonthEn</button> : June</h6>
        </div>
        <div class="card mx-3 shadow-sm rounded m-1">
            <h6 class="pt-2 pl-2"> <button value="@{{NothiNumber}}" class="btn btn-sm btn-primary mb-2 getInstructionValue">NothiNumber</button></h6>
        </div>

        <div class="card mx-3 shadow-sm rounded m-1">
            <h6 class="pt-2 pl-2"> <button value="@{{currentYearEn2D}}" class="btn btn-sm btn-primary mb-2 getInstructionValue">currentYearEn2D</button> : 23</h6>
        </div>
        <div class="card mx-3 shadow-sm rounded m-1">
            <h6 class="pt-2 pl-2"> <button value="@{{ApplicationId}}" class="btn btn-sm btn-primary mb-2 getInstructionValue">ApplicationId</button></h6>
        </div>
        <div class="card mx-3 shadow-sm rounded m-1">
            <h6 class="pt-2 pl-2"> <button value="@{{qrCode}}" class="btn btn-sm btn-primary mb-2 getInstructionValue">qrCode </button></h6>
        </div>
    </div>


    <script>

        var sidebarOpen = true;

        function toggleSidebar1() {


            if (sidebarOpen) {
                document.getElementById("mySidebar1").style.width = "370px";
            } else {
                document.getElementById("mySidebar1").style.width = "0";
            }

            sidebarOpen = !sidebarOpen;
        }
    </script>
