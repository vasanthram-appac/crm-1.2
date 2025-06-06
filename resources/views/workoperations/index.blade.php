@extends('layouts/app')

@section('title','Work Operations')

@section('css')
<style>
    .odd {
        background-color: #0515263d !important;
    }

    .buttons-csv {
        background-color: #01152b !important;
        color: #fff !important;
    }

    .buttons-excel {
        background-color: #01152b !important;
        color: #fff !important;
    }

    .buttons-collection {
        background-color: #01152b !important;
        color: #fff !important;
    }
</style>
@endsection

@section('content')

<div class="appac_show"></div>

<div class="row m-0 appac_hide col-wrap ">

    <div class="lead-charthed d-flex flex-wrap pt-4 row-gap-3">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 p-0 ">

            <div class="row admin  dash-pie-chart">
            @if(request()->session()->get('role') != 'user')
            <div class="g-data ps-3"><a href="/task">
                        <div class="bio  rounded-30  piechart-leads dash-1">
                            <div class="svg-d">

                            <img src="/img/view-task.png"/>

                            </div>
                            <h3 class="text-center ">Task View</h3>
                            <h4>{{$task}}</h4>
                        </div>
                    </a>
                </div>

                <div class="g-data ps-3"><a href="/workorderview">
                        <div class="bio  rounded-30  piechart-leads dash-2">
                            <div class="svg-d">
                            <img  src="/img/work-order-view.png"/>
                            </div>
                            <h3 class="text-center">Work Order View</h3>
                            <h4>{{$workorder}}</h4>
                        </div>
                    </a>
                </div>

                <div class="g-data ps-3"><a href="/wip">
                        <div class="bio  rounded-30  piechart-leads dash-3">
                            <div class="svg-d">
                                 <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.1999 20.5C10.7985 20.5 8.62449 20.2815 8.50353 20.2571C5.96584 19.7421 4 15.8689 4 11.5C4 7.13455 5.96318 3.26165 8.49813 2.74288C8.62002 2.71802 10.7984 2.5 11.1996 2.5C14.1819 2.5 16.5995 6.52911 16.5995 11.4997C16.5995 16.4704 14.1819 20.4995 11.1996 20.4995L11.1999 20.5ZM12.1 16.9001C13.5911 16.9001 14.7999 14.4825 14.7999 11.5002C14.7999 8.51789 13.5911 6.10027 12.1 6.10027C10.6088 6.10027 9.39999 8.51789 9.39999 11.5002C9.39999 14.4825 10.6088 16.9001 12.1 16.9001ZM11.3862 7.37427C11.6344 7.1332 11.9056 7.00031 12.1896 7.00031C12.4744 7.00031 12.7463 7.1338 12.9949 7.37622C13.0568 7.43649 12.9679 7.9102 12.7284 8.79733C12.5474 9.4027 12.3678 9.70629 12.1896 9.70795C12.0113 9.70961 11.8328 9.40933 11.654 8.80713C11.4138 7.91186 11.3246 7.43424 11.3862 7.3743L11.3862 7.37427ZM13.5791 8.39443C13.7511 8.88725 13.8875 9.46642 13.9752 10.1161C14.0632 10.7675 14.0944 11.4304 14.0754 12.074C14.0707 12.2341 13.8559 12.1773 13.431 11.9035C13.1355 11.6767 12.96 11.3599 12.9043 10.9528C12.8487 10.5457 12.9122 10.0446 13.0952 9.44942C13.3749 8.62362 13.5363 8.27197 13.5791 8.39443L13.5791 8.39443ZM13.8531 13.7241C13.7114 14.2698 13.5245 14.7606 13.2946 15.1621C13.0643 15.5647 12.8116 15.8409 12.5513 15.9962C12.4865 16.0349 12.4426 15.5261 12.4196 14.47C12.4179 13.7243 12.489 13.2248 12.6328 12.9717C12.7766 12.7184 12.9945 12.7089 13.2863 12.9434C13.6995 13.3283 13.8884 13.5886 13.8531 13.7241L13.8531 13.7241ZM11.8298 15.998C11.5701 15.8425 11.3183 15.5666 11.0884 15.1651C10.858 14.7625 10.6707 14.2703 10.5288 13.7228C10.4935 13.5866 10.6811 13.3289 11.0918 12.9498C11.3863 12.7158 11.6058 12.724 11.7502 12.9747C11.8949 13.2253 11.9659 13.7205 11.9634 14.4604C11.9389 15.5241 11.8943 16.0367 11.8298 15.998L11.8298 15.998ZM10.3052 12.0734C10.2864 11.4314 10.3177 10.7703 10.4056 10.1206C10.4936 9.46928 10.6304 8.88875 10.8031 8.39504C10.846 8.27225 11.0058 8.6218 11.2828 9.44371C11.4663 10.0447 11.5309 10.5493 11.4764 10.9573C11.422 11.3655 11.2481 11.681 10.9547 11.9039C10.5263 12.1764 10.3098 12.2329 10.3053 12.0734L10.3052 12.0734Z" fill="#B1B5C3" />
                                </svg>
                            </div>
                            <h3 class="text-center ">WIP</h3>
                            <h4>{{$wip}}</h4>
                        </div>
                    </a>
                </div>
                <div class="g-data ps-3"><a href="/promotion">
                        <div class="bio  rounded-30  piechart-leads dash-4">
                            <div class="svg-d">
                             <img src="/img/promotion.png"/>
                            </div>
                            <h3 class="text-center">Promotion</h3>
                            <h4>{{$promotion}}</h4>
                        </div>
                    </a>
                </div>
                <div class="g-data  ps-3"><a href="/design">
                        <div class="bio  rounded-30  piechart-leads dash-5">
                            <div class="svg-d">
                             <img src="/img/web-design.png"/>
                            </div>
                            <h3 class="text-center">Design</h3>
                            <h4>{{$design}}</h4>
                        </div>
                    </a>
                </div>
                <div class="g-data  ps-3"><a href="/content">
                        <div class="bio  rounded-30  piechart-leads dash-6">
                            <div class="svg-d">
                                 <img src="/img/content.png"/>
                            </div>
                            <h3 class="text-center">Content</h3>
                            <h4>{{$content}}</h4>
                        </div>
                    </a>
                </div>
                @endif
                <div class="g-data  ps-3"><a href="/taskview">
                        <div class="bio  rounded-30  piechart-leads dash-7">
                            <div class="svg-d">
                                 <img src="/img/task.png"/>

                            </div>
                            <h3 class="text-center">Task</h3>
                            <h4>{{$taskview}}</h4>
                        </div>
                    </a>
                </div>

                <div class="g-data  ps-3"><a href="/workorder">
                        <div class="bio  rounded-30  piechart-leads dash-8">
						
                            <div class="svg-d">
                                <svg id="Layer_1" enable-background="new 0 0 468.021 468.021" height="20" viewBox="0 0 468.021 468.021" width="20" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev/svgjs"><g width="100%" height="100%" transform="matrix(1,0,0,1,0,0)"><g><path d="m434.01 392h-334.856c-6.382 0-6.34-6.919-2.731-10.036l74.478-63.964h238.549c2.966 0 5.426-2.677 5.484-5.638l2.985-154.034c.052-2.742-1.955-5.183-4.67-5.59l-52.688-7.926c-20.486 29.218-54.231 46.99-90.26 46.99-25.142 0-49.732-8.702-69.24-24.488-16.627-13.456-29.021-31.577-35.561-51.753l-35.127-5.264.155-.041-23.128-89.732c-1.619-6.291-7.283-10.524-13.77-10.524h-59.62v28h48.601l62.953 263.531-67.443 58.521c-24.613 19.487-10.322 60.948 21.033 60.948h57.756c-3.16 4-5.002 10.296-5.002 16.467 0 16.945 13.844 30.554 30.921 30.554s30.92-13.544 30.92-30.489c0-6.171-1.843-12.531-5.002-16.531h118.747c-3.16 4-5.002 10.296-5.002 16.467 0 16.945 13.844 30.554 30.921 30.554s30.921-13.544 30.921-30.489c0-6.171-1.843-12.531-5.002-16.531h54.68v-29.002z" fill="#b1b5c3" fill-opacity="1" data-original-color="#000000ff" stroke="none" stroke-opacity="1"/><path d="m270.302 0c-45.041 0-81.684 36.604-81.684 81.597s36.643 81.597 81.684 81.597 81.684-36.604 81.684-81.597-36.644-81.597-81.684-81.597zm-5.052 120.524c-5.696 6.068-15.871 5.8-21.235-.584l-24.597-29.262 21.754-18.344 14.306 17.019 42.888-45.685 20.717 19.512z" fill="#b1b5c3" fill-opacity="1" data-original-color="#000000ff" stroke="none" stroke-opacity="1"/></g></g></svg>

                            </div>
                            <h3 class="text-center">Work Order</h3>
                            <h4>{{$workorderview}}</h4>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </div>
   
</div>

@endsection


