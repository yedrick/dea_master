{{-- <button
    class="btn bg-slate-150 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80"
    @click="$notification({text:'This is a right top notification',variant:'info',position:'right-top'})" >
    Right Top
  </button> --}}
  <script>
    window.onload = function() {
        notificationHandler().triggerNotification();
      function notificationHandler() {
        return {
            triggerNotification() {
                this.$notification({
                    text: 'This is a right top notification',
                    variant: 'info',
                    position: 'right-top'
                });
            }
        }
    }
    }
  </script>
@if (session('success'))
  <script>
    window.onload = function() {
      $notification({
        text: '{{ session('success') }}',
        variant: 'success',
        position: 'right-top'
      });
    }
  </script>
@elseif (session('error'))
  <script>
    window.onload = function() {
      $notification({
        text: '{{ session('error') }}',
        variant: 'error',
        position: 'right-top'
      });
    }
  </script>
@endif
