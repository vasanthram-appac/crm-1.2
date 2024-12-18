<!-- ck editor -->


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<!-- DataTables Buttons CSS and JS -->
<script src="{{ asset('asset/js/jszip.min.js') }}" defer></script>

<!-- DataTables JS -->
<!-- <script src="{{ asset('js/buttons.min.js') }}" defer></script> -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<!-- DataTables Buttons JS -->
<script src="{{ asset('asset/js/buttons.min.js') }}" defer></script>
<script src="{{ asset('asset/js/colVis.min.js') }}" defer></script>

<!-- Optional: DataTables Buttons Flash export support -->
<script src="{{ asset('asset/js/html5.min.js') }}" defer></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<!-- bar chart script -->
<script src="https://www.gstatic.com/charts/loader.js"></script>
<script>
  function togglePasswordVisibility() {
    const passwordField = document.getElementById('password-field');
    const toggleIcon = document.getElementById('toggle-icon');

    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        passwordField.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    }
}
</script>
<script>
    // $(document).ready(function() {

    //     ClassicEditor
    //         .create(document.querySelector('#editor'))
    //         .then(editor => {
    //             editor.model.document.on('change:data', () => {
    //                 var content = editor.getData();

    //             });
    //         });

    // });

    setTimeout(function() {
        $('.secalert').hide();
    }, 3000);




    window.addEventListener('DOMContentLoaded', event => {
        // Toggle the side navigation
        const sidebarToggle = document.body.querySelector('#sidebarToggle');
        if (sidebarToggle) {
            // Uncomment Below to persist sidebar toggle between refreshes
            // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
            //     document.body.classList.toggle('sb-sidenav-toggled');
            // }
            sidebarToggle.addEventListener('click', event => {
                event.preventDefault();
                document.body.classList.toggle('sb-sidenav-toggled');
                localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
            });
        }
    });


    (function($) {
        "use strict";
        /*==================================================================
    [ Focus input ]*/
        $('.input100').each(function() {
            $(this).on('blur', function() {
                if ($(this).val().trim() != "") {
                    $(this).addClass('has-val');
                } else {
                    $(this).removeClass('has-val');
                }
            })
        })

    })(jQuery);

    var perfEntries = performance.getEntriesByType("navigation");

if (perfEntries[0].type === "back_forward") {
  location.reload();
}
(function() {
  window.onpageshow = function(event) {
    if (event.persisted) {
      window.location.reload();
    }
  };
})();


// For login input
document.querySelectorAll('.form-control').forEach((input) => {
    input.addEventListener('input', function () {
        if (this.value) {
            this.classList.add('has-value');
        } else {
            this.classList.remove('has-value');
        }
    });

    // Initial check in case the field is pre-filled
    if (input.value) {
        input.classList.add('has-value');
    }
});





function toggleMenu() {
  const hamburger = document.querySelector(".hamburger");
  const wrapper = document.getElementById("wrapper");

  // Toggle active and inactive classes for hamburger and wrapper
  hamburger.classList.toggle("active");
  wrapper.classList.toggle("active");
  wrapper.classList.toggle("inactive");
}
// Correct JavaScript code
 document.querySelectorAll('.menus span').forEach(menuSpan => {
    menuSpan.addEventListener('click', function () {
        const subMenu = this.querySelector('.sub-menu');
        const hamburger = document.querySelector(".hamburger");
        const wrapper = document.getElementById("wrapper");
        const isActive = this.classList.contains('active');

        // Remove 'active' from all .sub-menu and .menus span elements
        document.querySelectorAll('.sub-menu').forEach(sm => sm.classList.remove('active'));
        document.querySelectorAll('.menus span').forEach(span => span.classList.remove('active'));

        // If the clicked span is already active, remove its active state
        if (isActive) {
            // Remove active states without adding them again
            hamburger.classList.remove("active");
            wrapper.classList.remove("active");
            wrapper.classList.add("inactive");
        } else {
            // Otherwise, activate the clicked span and corresponding submenu
            if (subMenu) {
                subMenu.classList.add('active');
                this.classList.add('active');
                hamburger.classList.add("active");
                wrapper.classList.add("active");
                wrapper.classList.remove("inactive");
            }
        }
    });
});




    // Call the function with the desired menu id
 
function digi() {
    var date = new Date(),
      hour = date.getHours(),
      minute = checkTime(date.getMinutes()),
      ss = checkTime(date.getSeconds());

    function checkTime(i) {
      if (i < 10) {
        i = "0" + i;
      }
      return i;
    }

    if (hour > 12) {
      hour = hour - 12;
      if (hour == 12) {
        hour = checkTime(hour);
        document.getElementById("tt").innerHTML = hour + ":" + minute + ":" + ss + " ";
      } else {
        hour = checkTime(hour);
        document.getElementById("tt").innerHTML = hour + ":" + minute + ":" + ss + " ";
      }
    } else {
      document.getElementById("tt").innerHTML = hour + ":" + minute + ":" + ss + " ";;
    }
    var time = setTimeout(digi, 1000);
  }


// bar chart script starts

google.charts.load('current', {packages: ['corechart']});
  google.charts.setOnLoadCallback(drawChart);

function drawChart() {
    const data = google.visualization.arrayToDataTable([
        ['Day', 'Leads', { role: 'style' }, { role: 'tooltip', p: { html: true } }],
        ['Mon', 10, '#d9e1ef', customTooltip('Mon', 10)],
        ['Tue', 15, '#d9e1ef', customTooltip('Tue', 15)],
        ['Wed', 13, '#d9e1ef', customTooltip('Wed', 13)],
        ['Thu', 23, '#d9e1ef', customTooltip('Thu', 23)],
        ['Fri', 17, '#d9e1ef', customTooltip('Fri', 17)],
        ['Sat', 14, '#d9e1ef', customTooltip('Sat', 14)],
        ['Sun', 18, '#d9e1ef', customTooltip('Sun', 18)]
    ]);

    const options = {
        title: 'Graph',
        hAxis: {
            title: '',
            textStyle: { color: '#666', fontSize: 12 }
        },
        vAxis: {
            minValue: 0,
            maxValue: 25,
            gridlines: { color: '#eaeaea' },
            textStyle: { color: '#666' }
        },
        legend: 'none',
        chartArea: { width: '80%', height: '70%' },
        tooltip: { isHtml: true },
        animation: {
            startup: true, // Animation only on load
            duration: 1000, // Longer duration for better visibility
            easing: 'out'
        },
        // Add series options for rounding
        series: {
            0: {
                type: 'bars', // Specify that this is a bar chart
                bar: { groupWidth: '75%', // You can adjust the width if needed
                       cornerRadius: '50%' } // Set the corner radius
            }
        }
    };


    const chart = new google.visualization.ColumnChart(document.getElementById('bar_chart'));

    // No hover redraw logic is needed, only the initial chart draw
    chart.draw(data, options);
}

function customTooltip(day, leads) {
    return `
        <div style="padding: 8px; color: #fff; background-color: #333; border-radius: 5px;">
            <strong>${day}</strong><br>
            <span style="color: #5884c1;">●</span> ${leads} No's
        </div>`;
}
// bar chart script ends
// pie chart starts
google.charts.load("current", { packages: ["corechart"] });
google.charts.setOnLoadCallback(drawCharts);

function drawCharts() {
  drawSemiCircleChart("chart1", 30, "#5884c1", "Hot Leads");
  drawSemiCircleChart("chart2", 50, "#8caacf", "Warm Leads");
  drawSemiCircleChart("chart3", 70, "#7ab6db", "Cold Leads");
  drawSemiCircleChart("chart4", 70, "#a4a5a7", "Rejected Leads");
}

function drawSemiCircleChart(elementId, percentage, color, label ,status) {
  const data = google.visualization.arrayToDataTable([
    ["Label", "Value"],
    ["Progress", percentage],
    ["", 100 - percentage]


  ]);
  var status;
  const options = {
    animation: {
      startup: true,
      duration: 1500,
      easing: 'out'
    },
    pieHole: 0.7,
    pieSliceTextStyle: { color: "transparent" },
    pieSliceBorderColor: "transparent",
    legend: "none",
    pieStartAngle: 180,
    pieEndAngle: 130,
    slices: {
      0: { color: color },
      1: { color: "#e6e6e6" }
    },

  };

  const chart = new google.visualization.PieChart(document.getElementById(elementId));
  chart.draw(data, options);

  // Add the percentage label and description in the center
  document.getElementById(elementId).innerHTML += `
    <div class="chart-label">
      <div>${percentage}%</div>
      <div class="status">${status}</div>
      <div>${label}</div>
    </div>
  `;
}
// pie chart ends
</script>