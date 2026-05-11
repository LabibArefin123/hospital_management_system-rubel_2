<div class="card border-0 shadow-sm mb-4">

    <div class="card-body">

        <div class="row align-items-center">

            <div class="col-lg-5 col-md-6 mb-3 mb-md-0">

                <label class="font-weight-bold mb-2">
                    Search Appointment
                </label>

                <div class="input-group">

                    <div class="input-group-prepend">
                        <span class="input-group-text bg-primary border-0 text-white">
                            <i class="fas fa-search"></i>
                        </span>
                    </div>

                    <input type="text" id="dashboardSearch" class="form-control border-0 shadow-none"
                        placeholder="Search patient, doctor or service...">

                </div>

            </div>

            <div class="col-lg-3 col-md-3">

                <label class="font-weight-bold mb-2">
                    Appointment Type
                </label>

                <select id="appointmentTypeFilter" class="form-control">

                    <option value="">
                        All
                    </option>

                    <option value="doctor">
                        Doctor Consultation
                    </option>

                    <option value="service">
                        Service Booking
                    </option>

                </select>

            </div>

            <div class="col-lg-2 col-md-3">

                <label class="font-weight-bold mb-2">
                    Status
                </label>

                <select id="appointmentStatusFilter" class="form-control">

                    <option value="">
                        All
                    </option>

                    <option value="pending">
                        Pending
                    </option>

                    <option value="confirmed">
                        Confirmed
                    </option>

                    <option value="cancelled">
                        Cancelled
                    </option>

                </select>

            </div>

            <div class="col-lg-2 mt-4">

                <button id="resetDashboardFilter" class="btn btn-danger btn-block">

                    <i class="fas fa-sync-alt mr-1"></i>

                    Reset

                </button>

            </div>

        </div>

    </div>

</div>
