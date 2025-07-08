@extends('layout.layout')

<head>
    <meta charset="UTF-8">
    <title>New Request</title>
    <link rel="stylesheet" href="{{ asset('css/assessment-request.css') }}">

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const statusSelect = document.getElementById('status');
        const ghinaStep = document.getElementById('ghina-step');
        const ghinaDesc = document.getElementById('ghina-desc');

        const updateWorkflowClassAndText = (value) => {
            ghinaStep.classList.remove('approved', 'in-progress', 'rejected', 'pending');
            let className = 'pending';
            if (value === 'approved') className = 'approved';
            else if (value === 'in progress') className = 'in-progress';
            else if (value === 'rejected') className = 'rejected';
            ghinaStep.classList.add(className);

            const capitalized = value.charAt(0).toUpperCase() + value.slice(1);
            ghinaDesc.textContent = `Data Owner ${capitalized}`;
        };

        updateWorkflowClassAndText(statusSelect.value.toLowerCase());

        statusSelect.addEventListener('change', function () {
            updateWorkflowClassAndText(this.value.toLowerCase());
        });
    });

    function toggleDropdown(button) {
        const dropdown = button.nextElementSibling;
        const allDropdowns = document.querySelectorAll('.dropdown-menu');
        allDropdowns.forEach(menu => {
            if (menu !== dropdown) menu.style.display = 'none';
        });
        dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
    }

    function selectReason(element) {
        const selected = element.textContent;
        alert("Rejected with reason: " + selected);
        closeAllDropdowns();
    }

    function selectOtherReason(element) {
        const dropdown = element.closest('.dropdown-menu');
        const input = dropdown.querySelector('.other-input');
        input.style.display = 'block';
        input.focus();
    }

    function closeAllDropdowns() {
        document.querySelectorAll('.dropdown-menu').forEach(d => d.style.display = 'none');
        document.querySelectorAll('.other-input').forEach(i => i.style.display = 'none');
    }

    document.addEventListener('click', function (e) {
        if (!e.target.closest('.dropdown-wrapper')) {
            closeAllDropdowns();
        }
    });
</script>
</head>

@section('content')
<div class="assessment-container">
    <div class="left-section">
        <div class="box">
            <div class="box-header">
                <strong>Assessment Request Detail</strong>
                <span>No Request : 123456</span>
            </div>
            <hr class="section-divider">
            <div class="table-section">
                {{-- Table 1 --}}
                <label>Table 1 Name</label>
                <input type="text" name="table1_name" value="User Data Table">

                <label>Table 1 Desc</label>
                <input type="text" name="table1_desc" value="Contains personal data of registered users">

                <table>
                    <thead>
                        <tr>
                            <th>Field</th>
                            <th>Description</th>
                            <th>Confidentiality</th>
                            <th>PII</th>
                            <th>Action</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Full Name</td>
                            <td>User's full legal name</td>
                            <td>High</td>
                            <td>Yes</td>
                            <td class="action-cell">
                                <div class="action-buttons">
                                    <button class="approve-button">Approve</button>
                                    <div class="dropdown-wrapper">
                                        <button class="reject-button" onclick="toggleDropdown(this)">Reject &#9662;</button>
                                        <div class="dropdown-menu">
                                            <div class="dropdown-option" onclick="selectReason(this)">Alasan #1</div>
                                            <div class="dropdown-option" onclick="selectReason(this)">Alasan #2</div>
                                            <div class="dropdown-option" onclick="selectReason(this)">Alasan #3</div>
                                            <div class="dropdown-option other-option" onclick="selectOtherReason(this)">Other</div>
                                            <input type="text" class="other-input" placeholder="Tuliskan alasan lain..." style="display:none;">
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>Name is used for user identification</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>User email address</td>
                            <td>Medium</td>
                            <td>Yes</td>
                            <td class="action-cell">
                                <div class="action-buttons">
                                    <button class="approve-button">Approve</button>
                                    <div class="dropdown-wrapper">
                                        <button class="reject-button" onclick="toggleDropdown(this)">Reject &#9662;</button>
                                        <div class="dropdown-menu">
                                            <div class="dropdown-option" onclick="selectReason(this)">Alasan #1</div>
                                            <div class="dropdown-option" onclick="selectReason(this)">Alasan #2</div>
                                            <div class="dropdown-option" onclick="selectReason(this)">Alasan #3</div>
                                            <div class="dropdown-option other-option" onclick="selectOtherReason(this)">Other</div>
                                            <input type="text" class="other-input" placeholder="Tuliskan alasan lain..." style="display:none;">
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>Used for login and communication</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>User home address</td>
                            <td>High</td>
                            <td>Yes</td>
                            <td class="action-cell">
                                <div class="action-buttons">
                                    <button class="approve-button">Approve</button>
                                    <div class="dropdown-wrapper">
                                        <button class="reject-button" onclick="toggleDropdown(this)">Reject &#9662;</button>
                                        <div class="dropdown-menu">
                                            <div class="dropdown-option" onclick="selectReason(this)">Alasan #1</div>
                                            <div class="dropdown-option" onclick="selectReason(this)">Alasan #2</div>
                                            <div class="dropdown-option" onclick="selectReason(this)">Alasan #3</div>
                                            <div class="dropdown-option other-option" onclick="selectOtherReason(this)">Other</div>
                                            <input type="text" class="other-input" placeholder="Tuliskan alasan lain..." style="display:none;">
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>Used for user information</td>
                        </tr>
                    </tbody>
                </table>

                <hr class="section-divider">

                {{-- Table 2 --}}
                <label>Table 2 Name</label>
                <input type="text" name="table2_name" value="Transaction History">

                <label>Table 2 Desc</label>
                <input type="text" name="table2_desc" value="Stores records of all user purchases">

                <table>
                    <thead>
                        <tr>
                            <th>Field</th>
                            <th>Description</th>
                            <th>Confidentiality</th>
                            <th>PII</th>
                            <th>Action</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Transaction ID</td>
                            <td>Unique identifier for each purchase</td>
                            <td>Medium</td>
                            <td>No</td>
                            <td class="action-cell">
                                <div class="action-buttons">
                                    <button class="approve-button">Approve</button>
                                    <div class="dropdown-wrapper">
                                        <button class="reject-button" onclick="toggleDropdown(this)">Reject &#9662;</button>
                                        <div class="dropdown-menu">
                                            <div class="dropdown-option" onclick="selectReason(this)">Alasan #1</div>
                                            <div class="dropdown-option" onclick="selectReason(this)">Alasan #2</div>
                                            <div class="dropdown-option" onclick="selectReason(this)">Alasan #3</div>
                                            <div class="dropdown-option other-option" onclick="selectOtherReason(this)">Other</div>
                                            <input type="text" class="other-input" placeholder="Tuliskan alasan lain..." style="display:none;">
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>Used for tracking and audit</td>
                        </tr>
                        <tr>
                            <td>Product ID</td>
                            <td>Unique identifier for each product</td>
                            <td>Medium</td>
                            <td>No</td>
                            <td class="action-cell">
                                <div class="action-buttons">
                                    <button class="approve-button">Approve</button>
                                    <div class="dropdown-wrapper">
                                        <button class="reject-button" onclick="toggleDropdown(this)">Reject &#9662;</button>
                                        <div class="dropdown-menu">
                                            <div class="dropdown-option" onclick="selectReason(this)">Alasan #1</div>
                                            <div class="dropdown-option" onclick="selectReason(this)">Alasan #2</div>
                                            <div class="dropdown-option" onclick="selectReason(this)">Alasan #3</div>
                                            <div class="dropdown-option other-option" onclick="selectOtherReason(this)">Other</div>
                                            <input type="text" class="other-input" placeholder="Tuliskan alasan lain..." style="display:none;">
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>Used for tracking stock and product availability</td>
                        </tr>
                        <tr>
                            <td>Customer ID</td>
                            <td>Unique identifier for each customer</td>
                            <td>Medium</td>
                            <td>No</td>
                            <td class="action-cell">
                                <div class="action-buttons">
                                    <button class="approve-button">Approve</button>
                                    <div class="dropdown-wrapper">
                                        <button class="reject-button" onclick="toggleDropdown(this)">Reject &#9662;</button>
                                        <div class="dropdown-menu">
                                            <div class="dropdown-option" onclick="selectReason(this)">Alasan #1</div>
                                            <div class="dropdown-option" onclick="selectReason(this)">Alasan #2</div>
                                            <div class="dropdown-option" onclick="selectReason(this)">Alasan #3</div>
                                            <div class="dropdown-option other-option" onclick="selectOtherReason(this)">Other</div>
                                            <input type="text" class="other-input" placeholder="Tuliskan alasan lain..." style="display:none;">
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>Used for customer information</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="save-button-container">
                <button class="save-button">Save</button>
            </div>
        </div>

        {{-- Status & Sidebar --}}
        <div class="box">
            <div class="box-header">Assessment Request Status</div>
            <hr class="section-divider">

            <div class="data-owner">
                <strong>Data Owner</strong>
                <div class="form-group">
                    <label>NIK</label>
                    <input type="text" name="nik" value="198765432100001">
                </div>
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama" value="Ghina Law">
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="status">
                        <option value="pending" selected>Pending</option>
                        <option value="in progress">In Progress</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                    </select>
                    <span class="note">*Nanti ada Pop up untuk isi keterangan</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Right Section --}}
    <div class="right-section">
        <div class="workflow box">
            <div class="box-header">Workflow Information</div>
            <div class="workflow-flow">
                <div id="ghina-step" class="workflow-step pending">
                    <div class="circle"></div>
                    <div class="line"></div>
                    <div class="workflow-text">
                        <strong>Ghina Law</strong><br>
                        <small id="ghina-desc">Data Owner Pending</small>
                    </div>
                </div>
                <div class="workflow-step approved">
                    <div class="circle"></div>
                    <div class="line"></div>
                    <div class="workflow-text">
                        <strong>Lawrance Liu</strong><br>
                        <small>Service Desk Created Ticket</small>
                    </div>
                </div>
                <div class="workflow-step approved">
                    <div class="circle"></div>
                    <div class="workflow-text">
                        <strong>Jhonny Seo</strong><br>
                        <small>User Request for Assessment</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="history box">
            <div class="box-header">Activity/History</div>
            <div class="history-entry">
                <div class="dot"></div>
                <div class="text">
                    <strong>Changes Done</strong><br>
                    <small>30 Juni 2025 14:33 | John Doe</small>
                </div>
            </div>
            <div class="history-entry">
                <div class="dot"></div>
                <div class="text">
                    <strong>Ticket Created</strong><br>
                    <small>29 Juni 2025 10:21 | Lawrance Liu</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
