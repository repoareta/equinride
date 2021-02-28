@if ($stableSlotSettings->isNotEmpty())
    <div class="alert alert-custom alert-light fade show" role="alert">
        <div class="alert-text font-weight-bold">
            We close the stable at every
            @php
                $result = '';
                foreach($stableSlotSettings as $stableSlotSetting) {
                    if ($stableSlotSetting->closed_day == 1) {
                        $result .= 'Monday'.', ';
                    }
                    if ($stableSlotSetting->closed_day == 2) {
                        $result .= 'Tuesday'.', ';
                    }
                    if ($stableSlotSetting->closed_day == 3) {
                        $result .= 'Wednesday'.', ';
                    }
                    if ($stableSlotSetting->closed_day == 4) {
                        $result .= 'Thursday'.', ';
                    }
                    if ($stableSlotSetting->closed_day == 5) {
                        $result .= 'Friday'.', ';
                    }
                    if ($stableSlotSetting->closed_day == 6) {
                        $result .= 'Saturday'.', ';
                    }
                    if ($stableSlotSetting->closed_day == 7) {
                        $result .= 'Sunday'.', ';
                    }
                }
                $result = rtrim($result,', ');
            @endphp
            {{ $result }}
            <br>
            Go to <a href="{{ route('stable.schedule.setting') }}">schedule settings</a>.
        </div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">
                    <i class="ki ki-close"></i>
                </span>
            </button>
        </div>
    </div>     
@endif