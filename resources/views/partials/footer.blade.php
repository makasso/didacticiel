 <!-- Backend Bundle JavaScript -->
 <script src="{{ asset('assets/js/backend-bundle.min.js') }}"></script>

 <!-- Table Treeview JavaScript -->
 <script src="{{ asset('assets/js/table-treeview.js') }}"></script>

 <!-- Chart Custom JavaScript -->
 <script src="{{ asset('assets/js/customizer.js') }}"></script>

 <!-- Chart Custom JavaScript -->
 <script async src="{{ asset('assets/js/chart-custom.js') }}"></script>
 <!-- Chart Custom JavaScript -->
 <script async src="{{ asset('assets/js/slider.js') }}"></script>
 <!-- app JavaScript -->
 <script src="{{ asset('assets/js/app.js') }}"></script>
 <script src="{{ asset('assets/vendor/moment.min.js') }}"></script>

 <script src="https://code.jquery.com/jquery-3.7.1.min.js"
     integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
 <script src="https://cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
 <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"
     integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"
     integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ=="
     crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
 <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>


 <script>
     const Toast = Swal.mixin({
         toast: true,
         position: "top-end",
         showConfirmButton: false,
         timer: 3000,
         timerProgressBar: true,
         didOpen: (toast) => {
             toast.onmouseenter = Swal.stopTimer;
             toast.onmouseleave = Swal.resumeTimer;
         }
     });

     function destroyAllModals() {
         $('.modal').hide();
         $('.modal-backdrop').remove();
     }

 </script>
