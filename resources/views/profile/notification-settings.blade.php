<x-app-layout>
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card surface-card">
                    <div class="card-header bg-light border-bottom">
                        <h5 class="card-title fw-bold mb-0" style="color: #1E3A5F;">
                            <i class="bi bi-bell me-2"></i>Notification Settings
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('settings.notifications') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Deadline Reminder Emails -->
                            <div class="d-flex justify-content-between align-items-center mb-4 pb-4 border-bottom">
                                <div>
                                    <h6 class="fw-600 mb-1">Deadline Reminder Emails</h6>
                                    <p class="text-muted small mb-0">Get notified when task deadlines are approaching</p>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="deadline_reminder_emails" name="deadline_reminder_emails" value="1" 
                                        @if(auth()->user()->deadline_reminder_emails) checked @endif style="width: 3rem; height: 1.5rem; cursor: pointer;">
                                </div>
                            </div>

                            <!-- Task Assignment Notifications -->
                            <div class="d-flex justify-content-between align-items-center mb-4 pb-4 border-bottom">
                                <div>
                                    <h6 class="fw-600 mb-1">Task Assignment Notifications</h6>
                                    <p class="text-muted small mb-0">Get notified when new tasks are assigned to you</p>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="task_assignment_notifications" name="task_assignment_notifications" value="1" 
                                        @if(auth()->user()->task_assignment_notifications) checked @endif style="width: 3rem; height: 1.5rem; cursor: pointer;">
                                </div>
                            </div>

                            <!-- Status Update Alerts -->
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div>
                                    <h6 class="fw-600 mb-1">Status Update Alerts</h6>
                                    <p class="text-muted small mb-0">Get notified when task status changes</p>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="status_update_alerts" name="status_update_alerts" value="1" 
                                        @if(auth()->user()->status_update_alerts) checked @endif style="width: 3rem; height: 1.5rem; cursor: pointer;">
                                </div>
                            </div>

                            <div class="d-flex gap-2 pt-3">
                                <button type="submit" class="btn btn-primary" style="background-color: #1E3A5F; border-color: #1E3A5F;">
                                    <i class="bi bi-check-circle me-2"></i>Save Settings
                                </button>
                                <a href="{{ route('profile.show') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-x-circle me-2"></i>Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
