@extends('vendor.installer.layouts.master')

@section('template_title')
    {{ trans('installer_messages.environment.wizard.templateTitle') }}
@endsection

@section('title')
    <i class="fa fa-magic fa-fw" aria-hidden="true"></i>
    {!! trans('installer_messages.environment.wizard.title') !!}
@endsection

@section('container')
    <div class="tabs tabs-full">

        <input id="tab1" type="radio" name="tabs" class="tab-input" checked />
        <label for="tab1" class="tab-label">
            <i class="fa fa-user fa-2x fa-fw" aria-hidden="true"></i>
            <br />
            App Info
        </label>

        <input id="tab2" type="radio" name="tabs" class="tab-input" />
        <label for="tab2" class="tab-label">
            <i class="fa fa-database fa-2x fa-fw" aria-hidden="true"></i>
            <br />
            {{ trans('installer_messages.environment.wizard.tabs.database') }}
        </label>

        <input id="tab3" type="radio" name="tabs" class="tab-input" />
        <label for="tab3" class="tab-label">
            <i class="fa fa-envelope fa-2x fa-fw" aria-hidden="true"></i>
            <br />
            {{ trans('installer_messages.environment.wizard.tabs.email') }}
        </label>

        <form method="post" action="{{ route('LaravelInstaller::environmentSaveWizard') }}" class="tabs-wrap" novalidate>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="tab" id="tab1content">
                <input type="hidden" name="app_name" value="Saelos" />
                <input type="hidden" name="environment" value="production" />
                <input type="hidden" name="app_debug" value="false" />
                <input type="hidden" name="app_log_level" value="critical" />

                <div class="form-group {{ $errors->has('app_url') ? ' has-error ' : '' }}">
                    <label for="app_url">
                        {{ trans('installer_messages.environment.wizard.form.app_url_label') }}
                    </label>
                    <input type="url" name="app_url" id="app_url" value="http://" class="form-control" placeholder="{{ trans('installer_messages.environment.wizard.form.app_url_placeholder') }}" />
                    @if ($errors->has('app_url'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('app_url') }}
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('user_name') ? ' has-error ' : '' }}">
                    <label for="user_name">
                        Your Name
                    </label>
                    <input type="text" name="user_name" id="user_name" value="" class="form-control" placeholder="Name" />
                    @if ($errors->has('user_name'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('user_name') }}
                        </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('user_username') ? ' has-error ' : '' }}">
                    <label for="user_username">
                        Username
                    </label>
                    <input type="text" name="user_username" id="user_username" value="" class="form-control" placeholder="Username" />
                    @if ($errors->has('user_username'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('user_username') }}
                        </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('user_email') ? ' has-error ' : '' }}">
                    <label for="user_email">
                        Email
                    </label>
                    <input type="email" name="user_email" id="user_email" value="" class="form-control" placeholder="Email" />
                    @if ($errors->has('user_email'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('user_email') }}
                        </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('user_password') ? ' has-error ' : '' }}">
                    <label for="user_password">
                        Password
                    </label>
                    <input type="password" name="user_password" id="user_password" value="" class="form-control" placeholder="Password" />
                    @if ($errors->has('user_password'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('user_password') }}
                        </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('app_timezone') ? ' has-error ' : '' }}">
                    <label for="app_timezone">
                        {{ trans('installer_messages.environment.wizard.form.app_timezone_label') }}
                    </label>
                    <input type="text" name="app_timezone" id="app_timezone" value="" class="form-control" placeholder="UTC" />
                    @if ($errors->has('app_timezone'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('app_timezone') }}
                        </span>
                    @endif
                </div>

                <div class="buttons">
                    <button class="button" onclick="showDatabaseSettings();return false">
                        {{ trans('installer_messages.environment.wizard.form.buttons.setup_database') }}
                        <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
                    </button>
                </div>
            </div>

            <div class="tab" id="tab2content">

                <div class="form-group {{ $errors->has('database_connection') ? ' has-error ' : '' }}">
                    <label for="database_connection">
                        {{ trans('installer_messages.environment.wizard.form.db_connection_label') }}
                    </label>
                    <select name="database_connection" class="form-control" id="database_connection">
                        <option value="mysql" selected>{{ trans('installer_messages.environment.wizard.form.db_connection_label_mysql') }}</option>
                        <option value="sqlite">{{ trans('installer_messages.environment.wizard.form.db_connection_label_sqlite') }}</option>
                        <option value="pgsql">{{ trans('installer_messages.environment.wizard.form.db_connection_label_pgsql') }}</option>
                        <option value="sqlsrv">{{ trans('installer_messages.environment.wizard.form.db_connection_label_sqlsrv') }}</option>
                    </select>
                    @if ($errors->has('database_connection'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('database_connection') }}
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('database_hostname') ? ' has-error ' : '' }}">
                    <label for="database_hostname">
                        {{ trans('installer_messages.environment.wizard.form.db_host_label') }}
                    </label>
                    <input type="text" name="database_hostname" id="database_hostname" value="127.0.0.1" class="form-control" placeholder="{{ trans('installer_messages.environment.wizard.form.db_host_placeholder') }}" />
                    @if ($errors->has('database_hostname'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('database_hostname') }}
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('database_port') ? ' has-error ' : '' }}">
                    <label for="database_port">
                        {{ trans('installer_messages.environment.wizard.form.db_port_label') }}
                    </label>
                    <input type="number" name="database_port" id="database_port" value="3306" class="form-control" placeholder="{{ trans('installer_messages.environment.wizard.form.db_port_placeholder') }}" />
                    @if ($errors->has('database_port'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('database_port') }}
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('database_name') ? ' has-error ' : '' }}">
                    <label for="database_name">
                        {{ trans('installer_messages.environment.wizard.form.db_name_label') }}
                    </label>
                    <input type="text" name="database_name" id="database_name" value="" class="form-control" placeholder="{{ trans('installer_messages.environment.wizard.form.db_name_placeholder') }}" />
                    @if ($errors->has('database_name'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('database_name') }}
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('database_username') ? ' has-error ' : '' }}">
                    <label for="database_username">
                        {{ trans('installer_messages.environment.wizard.form.db_username_label') }}
                    </label>
                    <input type="text" name="database_username" id="database_username" value="" class="form-control" placeholder="{{ trans('installer_messages.environment.wizard.form.db_username_placeholder') }}" />
                    @if ($errors->has('database_username'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('database_username') }}
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('database_password') ? ' has-error ' : '' }}">
                    <label for="database_password">
                        {{ trans('installer_messages.environment.wizard.form.db_password_label') }}
                    </label>
                    <input type="password" name="database_password" id="database_password" value="" class="form-control" placeholder="{{ trans('installer_messages.environment.wizard.form.db_password_placeholder') }}" />
                    @if ($errors->has('database_password'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('database_password') }}
                        </span>
                    @endif
                </div>

                <div class="buttons">
                    <button class="button" onclick="showApplicationSettings();return false">
                        {{ trans('installer_messages.environment.wizard.form.buttons.setup_application') }}
                        <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
            <div class="tab" id="tab3content">
                <input type="hidden" name="broadcast_driver" value="log" />
                <input type="hidden" name="cache_driver" value="file" />
                <input type="hidden" name="session_driver" value="file" />
                <input type="hidden" name="queue_driver" value="null" />
                <input type="hidden" name="redis_hostname" value="null" />
                <input type="hidden" name="redis_password" value="null" />
                <input type="hidden" name="redis_port" value="6379" />
                <input type="hidden" name="pusher_app_id" value="" />
                <input type="hidden" name="pusher_app_key" value="" />
                <input type="hidden" name="pusher_app_secret" value="" />

                <div class="form-group {{ $errors->has('mail_driver') ? ' has-error ' : '' }}">
                    <label for="mail_driver">
                        {{ trans('installer_messages.environment.wizard.form.app_tabs.mail_driver_label') }}
                    </label>
                    <input type="text" name="mail_driver" id="mail_driver" value="smtp" class="form-control" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_driver_placeholder') }}" />
                    @if ($errors->has('mail_driver'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('mail_driver') }}
                        </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('mail_host') ? ' has-error ' : '' }}">
                    <label for="mail_host">{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_host_label') }}</label>
                    <input type="text" name="mail_host" id="mail_host" value="smtp.mailtrap.io" class="form-control" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_host_placeholder') }}" />
                    @if ($errors->has('mail_host'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('mail_host') }}
                        </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('mail_port') ? ' has-error ' : '' }}">
                    <label for="mail_port">{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_port_label') }}</label>
                    <input type="number" name="mail_port" id="mail_port" value="2525" class="form-control" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_port_placeholder') }}" />
                    @if ($errors->has('mail_port'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('mail_port') }}
                        </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('mail_username') ? ' has-error ' : '' }}">
                    <label for="mail_username">{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_username_label') }}</label>
                    <input type="text" name="mail_username" id="mail_username" value="null" class="form-control" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_username_placeholder') }}" />
                    @if ($errors->has('mail_username'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('mail_username') }}
                        </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('mail_password') ? ' has-error ' : '' }}">
                    <label for="mail_password">{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_password_label') }}</label>
                    <input type="text" name="mail_password" id="mail_password" value="null" class="form-control" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_password_placeholder') }}" />
                    @if ($errors->has('mail_password'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('mail_password') }}
                        </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('mail_encryption') ? ' has-error ' : '' }}">
                    <label for="mail_encryption">{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_encryption_label') }}</label>
                    <input type="text" name="mail_encryption" id="mail_encryption" value="null" class="form-control" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_encryption_placeholder') }}" />
                    @if ($errors->has('mail_encryption'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('mail_encryption') }}
                        </span>
                    @endif
                </div>

                <div class="buttons">
                    <button class="button" type="submit">
                        {{ trans('installer_messages.environment.wizard.form.buttons.install') }}
                        <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </form>

    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
      function checkEnvironment(val) {
        var element=document.getElementById('environment_text_input');
        if(val=='other') {
          element.style.display='block';
        } else {
          element.style.display='none';
        }
      }
      function showDatabaseSettings() {
        document.getElementById('tab2').checked = true;
      }
      function showApplicationSettings() {
        document.getElementById('tab3').checked = true;
      }
    </script>
@endsection
