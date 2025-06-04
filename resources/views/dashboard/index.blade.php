@extends('layouts/app')

@section('title','Dashboard')

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

<div class="row m-0 appac_hide dash col-wrap ">

    <div class="lead-charthed d-flex flex-wrap pt-4 row-gap-3">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 p-0 ">

            <div class="row admin  dash-pie-chart">

                <div class="g-data ps-3"><a href="/lead">
                        <div class="bio  rounded-30  piechart-leads dash-1">
                            <div class="svg-d">

                                <svg id="Layer_1" enable-background="new 0 0 16 16" height="20" viewBox="0 0 16 16" width="20" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev/svgjs">
                                    <g width="100%" height="100%" transform="matrix(1,0,0,1,0,0)">
                                        <g id="user" fill="#37474f">
                                            <path d="m11.021 11.594c-.733.854-1.807 1.406-3.021 1.406-1.2 0-2.265-.54-2.998-1.377-2.276.603-5.002 1.677-5.002 3.377v1h16s0-.167 0-1c0-1.753-2.717-2.819-4.979-3.406z" fill="#b1b5c3" fill-opacity="1" data-original-color="#37474fff" stroke="none" stroke-opacity="1" />
                                            <path d="m4 5c0-.995-.037-5 3.969-5s4.031 4.083 4.031 5c0 2-1.438 6-4 6s-4-3.958-4-6z" fill="#b1b5c3" fill-opacity="1" data-original-color="#37474fff" stroke="none" stroke-opacity="1" />
                                        </g>
                                    </g>
                                </svg>

                            </div>
                            <h3 class="text-center ">Leads</h3>
                            <h4>{{$aallead}}</h4>
                        </div>
                    </a>
                </div>

                <div class="g-data ps-3"><a href="/opportunity">
                        <div class="bio  rounded-30  piechart-leads dash-2">
                            <div class="svg-d">
                                <svg id="Layer_1" enable-background="new 0 0 16 16" height="20" viewBox="0 0 16 16" width="20" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev/svgjs">
                                    <g width="100%" height="100%" transform="matrix(1,0,0,1,0,0)">
                                        <g id="star">
                                            <path d="m8 0c-4.418 0-8 3.582-8 8s3.582 8 8 8 8-3.582 8-8-3.582-8-8-8zm4 14-4-3-4 3 1-5-4-3h5l2-5 2 5h5l-4 3z" fill="#b1b5c3" fill-opacity="1" data-original-color="#37474fff" stroke="none" stroke-opacity="1" />
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <h3 class="text-center">Opportunity</h3>
                            <h4>{{$opportunity}}</h4>
                        </div>
                    </a>
                </div>

                <div class="g-data ps-3"><a href="/accounts">
                        <div class="bio  rounded-30  piechart-leads dash-3">
                            <div class="svg-d">

                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3.45417 11.1787L11.251 0.383071C11.7668 -0.331016 12.8934 0.139113 12.7486 1.00798L11.6666 7.49999H15.8701C16.55 7.49999 16.9437 8.27012 16.5457 8.82123L8.74883 19.6169C8.2331 20.331 7.10646 19.8609 7.25127 18.992L8.33327 12.5H4.12974C3.44993 12.5 3.05615 11.7299 3.45417 11.1787Z" fill="#B1B5C3" />
                                </svg>

                            </div>
                            <h3 class="text-center ">Accounts</h3>
                            <h4>{{$activeAcc}}</h4>
                        </div>
                    </a>
                </div>
                <div class="g-data ps-3"><a href="/accounts">
                        <div class="bio  rounded-30  piechart-leads dash-4">
                            <div class="svg-d">
                                <svg id="Icons" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg" width="20" height="20" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev/svgjs">
                                    <g width="100%" height="100%" transform="matrix(1,0,0,1,0,0)">
                                        <path d="m33.983 23h7.923l1.389-5h-7.923z" fill="#b1b5c3" fill-opacity="1" data-original-color="#000000ff" stroke="none" stroke-opacity="1" />
                                        <path d="m39 2.009c-4.866 0-9.73 1.852-13.436 5.556-7.407 7.408-7.407 19.463 0 26.871 7.408 7.406 19.463 7.406 26.871 0 7.407-7.408 7.407-19.463 0-26.871-3.704-3.703-8.57-5.556-13.436-5.556zm10 15.991h-3.628l-1.389 5h4.017c.553 0 1 .447 1 1s-.447 1-1 1h-4.573l-1.463 5.268c-.123.442-.525.732-.963.732-.089 0-.179-.012-.269-.036-.532-.148-.844-.699-.696-1.231l1.315-4.732h-7.924l-1.463 5.268c-.123.442-.525.732-.963.732-.089 0-.179-.012-.269-.036-.532-.148-.844-.699-.696-1.231l1.315-4.732h-3.351c-.553 0-1-.447-1-1s.447-1 1-1h3.906l1.389-5h-4.295c-.553 0-1-.447-1-1s.447-1 1-1h4.851l1.185-4.268c.148-.532.698-.841 1.231-.696.532.148.844.699.696 1.231l-1.037 3.732h7.924l1.185-4.268c.148-.532.699-.841 1.231-.696.532.148.844.699.696 1.231l-1.037 3.732h3.073c.553 0 1 .447 1 1s-.447 1-1 1z" fill="#b1b5c3" fill-opacity="1" data-original-color="#000000ff" stroke="none" stroke-opacity="1" />
                                        <path d="m20.778 31.396-18.681 18.691c-.051.054-.095.156-.097.251v7.353c0 .168.142.31.31.31h7.381c.121-.004.189-.054.232-.097l1.89-1.891c.054-.054.098-.176.074-.299l-.777-3.92c-.065-.327.038-.666.274-.902.237-.236.575-.337.903-.272l3.92.79c.097.024.224-.014.286-.076l1.78-1.78c.06-.062.098-.184.079-.273l-.774-3.947c-.064-.328.039-.666.276-.901.236-.235.571-.336.903-.271l3.91.79c.106.023.23-.021.285-.076l5.651-5.651c-1.591-.907-3.098-2.016-4.454-3.373-1.356-1.356-2.466-2.862-3.372-4.453z" fill="#b1b5c3" fill-opacity="1" data-original-color="#000000ff" stroke="none" stroke-opacity="1" />
                                    </g>
                                </svg>
                            </div>
                            <h3 class="text-center">Key Accounts</h3>
                            <h4>{{$keyaccounts}}</h4>
                        </div>
                    </a>
                </div>
                <div class="g-data  ps-3"><a href="/enquiryreport">
                        <div class="bio  rounded-30  piechart-leads dash-5">
                            <div class="svg-d">
                                <svg id="Capa_1" enable-background="new 0 0 512 512" height="20" viewBox="0 0 512 512" width="20" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev/svgjs">
                                    <g width="100%" height="100%" transform="matrix(1,0,0,1,0,0)">
                                        <g>
                                            <path d="m315 120c-5.306 0-10.519.379-15.72.795.403 4.693.72 9.41.72 14.205 0 90.981-74.019 165-165 165-4.796 0-9.512-.317-14.205-.72-.416 5.2-.795 10.413-.795 15.72 0 107.695 87.305 197 195 197h197l-53.004-61.637c32.78-34.889 53.004-83.714 53.004-135.363 0-107.695-89.305-195-197-195z" fill="#b1b5c3" fill-opacity="1" data-original-color="#000000ff" stroke="none" stroke-opacity="1" />
                                            <path d="m270 135c0-74.559-60.441-135-135-135s-135 60.441-135 135 60.441 135 135 135 135-60.441 135-135zm-135-82c24.901 0 45 20.099 45 45 0 19.499-10.499 29.399-18.3 36.599-6.226 5.572-11.7 10.424-11.7 22.8v.601h-30v-.601c0-25.499 12.9-37.2 21.301-45 6.599-6 8.699-8.399 8.699-14.399 0-8.401-6.599-15-15-15s-15 6.599-15 15h-30c0-24.901 20.099-45 45-45zm-15 135h30v30h-30z" fill="#b1b5c3" fill-opacity="1" data-original-color="#000000ff" stroke="none" stroke-opacity="1" />
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <h3 class="text-center">Enquiry</h3>
                            <h4>{{$website_enquiry_data}}</h4>
                        </div>
                    </a>
                </div>
                @if (request()->session()->get('empid') == 'AM090' || request()->session()->get('dept_id') == '6' || request()->session()->get('dept_id') == '1')
                <div class="g-data  ps-3"><a href="/proforma">
                        <div class="bio  rounded-30  piechart-leads dash-6">
                            <div class="svg-d">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.4164 17.9215L13.5197 14.8182L12.2237 13.5054L10.6892 15.0399L10.6891 5.15031L12.2236 6.68484L13.5366 5.37188L10.4162 2.2686C10.0581 1.91047 9.46142 1.91047 9.10328 2.2686L6 5.37188L7.31296 6.68484L8.84749 5.15031V15.0399L7.31296 13.5054L6 14.8183L9.10328 17.9216C9.47841 18.2795 10.0581 18.2795 10.4162 17.9214L10.4164 17.9215Z" fill="#95999C" />
                                </svg>
                            </div>
                            <h3 class="text-center">Proforma</h3>
                            <h4>{{$proforma}}</h4>
                        </div>
                    </a>
                </div>

                <div class="g-data  ps-3"><a href="invoice">
                        <div class="bio  rounded-30  piechart-leads dash-7">
                            <div class="svg-d">
                                <svg width="13" height="17" viewBox="0 0 13 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.38346 0.619057C6.31874 0.543522 6.2243 0.5 6.12484 0.5C6.02537 0.5 5.93093 0.543522 5.86621 0.619057C5.62468 0.901491 0 7.61517 0 10.8272C0.0180011 12.4349 0.672866 13.9699 1.82117 15.0951C2.96948 16.2204 4.51724 16.8442 6.12495 16.8298C7.73262 16.8442 9.28044 16.2204 10.4287 15.0951C11.577 13.9699 12.2319 12.435 12.2499 10.8272C12.2499 7.61517 6.62518 0.901386 6.38368 0.619057H6.38346ZM8.3196 14.9447C8.27266 14.9701 8.21991 14.983 8.16648 14.982C8.00971 14.9811 7.8738 14.8732 7.83745 14.7207C7.80111 14.5681 7.8738 14.4104 8.01336 14.339C8.66902 14.015 9.2216 13.5149 9.60919 12.8947C9.9969 12.2744 10.2042 11.5586 10.2081 10.8273C10.2081 10.6394 10.3604 10.4871 10.5484 10.4871C10.7363 10.4871 10.8886 10.6394 10.8886 10.8273C10.8852 11.6845 10.643 12.5237 10.1892 13.2511C9.73543 13.9783 9.08808 14.5647 8.31961 14.9446L8.3196 14.9447Z" fill="#B1B5C3" />
                                </svg>

                            </div>
                            <h3 class="text-center">Invoice</h3>
                            <h4>{{$invoice}}</h4>
                        </div>
                    </a>
                </div>

                <div class="g-data ps-3"><a href="/paymententry">
                        <div class="bio  rounded-30  piechart-leads dash-8">
                            <div class="svg-d">
                                <img src="/img/payment entry.png" />
                            </div>
                            <h3 class="text-center ">Payment Entry</h3>
                            <h4>{{$payment}}</h4>
                        </div>
                    </a>
                </div>

                <div class="g-data ps-3"><a href="/user">
                        <div class="bio  rounded-30  piechart-leads dash-4">
                            <div class="svg-d">
                                <img src="/img/employee.png" />
                            </div>
                            <h3 class="text-center ">Employee</h3>
                            <h4>{{$employee}}</h4>
                        </div>
                    </a>
                </div>
                @endif

                <div class="g-data  ps-3"><a href="/workorderview">
                        <div class="bio  rounded-30  piechart-leads dash-9">
                            <div class="svg-d">
                                <svg id="Layer_1" enable-background="new 0 0 468.021 468.021" height="20" viewBox="0 0 468.021 468.021" width="20" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev/svgjs">
                                    <g width="100%" height="100%" transform="matrix(1,0,0,1,0,0)">
                                        <g>
                                            <path d="m434.01 392h-334.856c-6.382 0-6.34-6.919-2.731-10.036l74.478-63.964h238.549c2.966 0 5.426-2.677 5.484-5.638l2.985-154.034c.052-2.742-1.955-5.183-4.67-5.59l-52.688-7.926c-20.486 29.218-54.231 46.99-90.26 46.99-25.142 0-49.732-8.702-69.24-24.488-16.627-13.456-29.021-31.577-35.561-51.753l-35.127-5.264.155-.041-23.128-89.732c-1.619-6.291-7.283-10.524-13.77-10.524h-59.62v28h48.601l62.953 263.531-67.443 58.521c-24.613 19.487-10.322 60.948 21.033 60.948h57.756c-3.16 4-5.002 10.296-5.002 16.467 0 16.945 13.844 30.554 30.921 30.554s30.92-13.544 30.92-30.489c0-6.171-1.843-12.531-5.002-16.531h118.747c-3.16 4-5.002 10.296-5.002 16.467 0 16.945 13.844 30.554 30.921 30.554s30.921-13.544 30.921-30.489c0-6.171-1.843-12.531-5.002-16.531h54.68v-29.002z" fill="#b1b5c3" fill-opacity="1" data-original-color="#000000ff" stroke="none" stroke-opacity="1" />
                                            <path d="m270.302 0c-45.041 0-81.684 36.604-81.684 81.597s36.643 81.597 81.684 81.597 81.684-36.604 81.684-81.597-36.644-81.597-81.684-81.597zm-5.052 120.524c-5.696 6.068-15.871 5.8-21.235-.584l-24.597-29.262 21.754-18.344 14.306 17.019 42.888-45.685 20.717 19.512z" fill="#b1b5c3" fill-opacity="1" data-original-color="#000000ff" stroke="none" stroke-opacity="1" />
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <h3 class="text-center">Work Order</h3>
                            <h4>{{$work_order}}</h4>
                        </div>
                    </a>
                </div>

                <div class="g-data ps-3"><a href="wip">
                        <div class="bio  rounded-30  piechart-leads dash-10">
                            <div class="svg-d"><svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.1999 20.5C10.7985 20.5 8.62449 20.2815 8.50353 20.2571C5.96584 19.7421 4 15.8689 4 11.5C4 7.13455 5.96318 3.26165 8.49813 2.74288C8.62002 2.71802 10.7984 2.5 11.1996 2.5C14.1819 2.5 16.5995 6.52911 16.5995 11.4997C16.5995 16.4704 14.1819 20.4995 11.1996 20.4995L11.1999 20.5ZM12.1 16.9001C13.5911 16.9001 14.7999 14.4825 14.7999 11.5002C14.7999 8.51789 13.5911 6.10027 12.1 6.10027C10.6088 6.10027 9.39999 8.51789 9.39999 11.5002C9.39999 14.4825 10.6088 16.9001 12.1 16.9001ZM11.3862 7.37427C11.6344 7.1332 11.9056 7.00031 12.1896 7.00031C12.4744 7.00031 12.7463 7.1338 12.9949 7.37622C13.0568 7.43649 12.9679 7.9102 12.7284 8.79733C12.5474 9.4027 12.3678 9.70629 12.1896 9.70795C12.0113 9.70961 11.8328 9.40933 11.654 8.80713C11.4138 7.91186 11.3246 7.43424 11.3862 7.3743L11.3862 7.37427ZM13.5791 8.39443C13.7511 8.88725 13.8875 9.46642 13.9752 10.1161C14.0632 10.7675 14.0944 11.4304 14.0754 12.074C14.0707 12.2341 13.8559 12.1773 13.431 11.9035C13.1355 11.6767 12.96 11.3599 12.9043 10.9528C12.8487 10.5457 12.9122 10.0446 13.0952 9.44942C13.3749 8.62362 13.5363 8.27197 13.5791 8.39443L13.5791 8.39443ZM13.8531 13.7241C13.7114 14.2698 13.5245 14.7606 13.2946 15.1621C13.0643 15.5647 12.8116 15.8409 12.5513 15.9962C12.4865 16.0349 12.4426 15.5261 12.4196 14.47C12.4179 13.7243 12.489 13.2248 12.6328 12.9717C12.7766 12.7184 12.9945 12.7089 13.2863 12.9434C13.6995 13.3283 13.8884 13.5886 13.8531 13.7241L13.8531 13.7241ZM11.8298 15.998C11.5701 15.8425 11.3183 15.5666 11.0884 15.1651C10.858 14.7625 10.6707 14.2703 10.5288 13.7228C10.4935 13.5866 10.6811 13.3289 11.0918 12.9498C11.3863 12.7158 11.6058 12.724 11.7502 12.9747C11.8949 13.2253 11.9659 13.7205 11.9634 14.4604C11.9389 15.5241 11.8943 16.0367 11.8298 15.998L11.8298 15.998ZM10.3052 12.0734C10.2864 11.4314 10.3177 10.7703 10.4056 10.1206C10.4936 9.46928 10.6304 8.88875 10.8031 8.39504C10.846 8.27225 11.0058 8.6218 11.2828 9.44371C11.4663 10.0447 11.5309 10.5493 11.4764 10.9573C11.422 11.3655 11.2481 11.681 10.9547 11.9039C10.5263 12.1764 10.3098 12.2329 10.3053 12.0734L10.3052 12.0734Z" fill="#B1B5C3" />
                                </svg>
                            </div>
                            <h3 class="text-center">WIP</h3>
                            <h4>{{$wip_history}}</h4>
                        </div>
                    </a>
                </div>

                <div class="g-data  ps-3"><a href="/employeereport">
                        <div class="bio  rounded-30  piechart-leads dash-1">
                            <div class="svg-d">
                                <svg id="Layer_1" enable-background="new 0 0 512 512" height="20" viewBox="0 0 512 512" width="20" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev/svgjs">
                                    <g width="100%" height="100%" transform="matrix(1,0,0,1,0,0)">
                                        <path clip-rule="evenodd" d="m20.517 8h294.687v57.003c0 11.585 9.415 21 21 21h57.003v137.888c-2.127-.103-4.267-.158-6.42-.158-72.181 0-130.695 58.514-130.695 130.695s58.514 130.695 130.695 130.695c2.153 0 4.292-.056 6.42-.158v9.035c0 5.508-4.492 10-10 10h-362.69c-5.508 0-10-4.492-10-10v-476c0-5.508 4.492-10 10-10zm366.271 270.442c-22.365 0-40.496 18.131-40.496 40.496s18.131 40.496 40.496 40.496 40.496-18.131 40.496-40.496-18.13-40.496-40.496-40.496zm0-22.71c-54.508 0-98.695 44.187-98.695 98.695 0 24.248 8.75 46.45 23.258 63.632 11.076-30.965 40.671-53.133 75.438-53.133 34.774 0 64.368 22.163 75.437 53.133 14.508-17.182 23.258-39.383 23.258-63.632-.001-54.508-44.189-98.695-98.696-98.695zm0-16c-63.345 0-114.695 51.351-114.695 114.695s51.351 114.695 114.695 114.695 114.695-51.35 114.695-114.695-51.351-114.695-114.695-114.695zm-55.584-230.865v56.136c0 2.754 2.246 5 5 5h56.136c-.485-1.062-1.173-2.039-2.062-2.929l-56.145-56.145c-.889-.889-1.867-1.577-2.929-2.062zm-242.592 160.628h226.5c4.418 0 8-3.582 8-8s-3.582-8-8-8h-226.5c-4.418 0-8 3.582-8 8s3.582 8 8 8zm0-66.75h162.593c4.418 0 8-3.582 8-8s-3.582-8-8-8h-162.593c-4.418 0-8 3.582-8 8s3.582 8 8 8zm0 333.749h154.709c4.418 0 8-3.582 8-8s-3.582-8-8-8h-154.709c-4.418 0-8 3.582-8 8 0 4.419 3.582 8 8 8zm0-66.75h154.709c4.418 0 8-3.582 8-8s-3.582-8-8-8h-154.709c-4.418 0-8 3.582-8 8 0 4.419 3.582 8 8 8zm0-66.75h154.709c4.418 0 8-3.582 8-8s-3.582-8-8-8h-154.709c-4.418 0-8 3.582-8 8 0 4.419 3.582 8 8 8zm0-66.749h226.5c4.418 0 8-3.582 8-8s-3.582-8-8-8h-226.5c-4.418 0-8 3.582-8 8s3.582 8 8 8z" fill-rule="evenodd" fill="#b1b5c3" fill-opacity="1" data-original-color="#000000ff" stroke="none" stroke-opacity="1" />
                                    </g>
                                </svg>
                            </div>
                            <h3 class="text-center">Employee Report</h3>
                            <h4>{{$dailyreport}}</h4>
                        </div>
                    </a>
                </div>

                <div class="g-data ps-3"><a href="/monthlyreport">
                        <div class="bio  rounded-30  piechart-leads dash-3">
                            <div class="svg-d">
                                <img src="/img/monthly-report.png" />
                            </div>
                            <h3 class="text-center ">Monthly Report</h3>
                            <h4>{{$empreport}}</h4>
                        </div>
                    </a>
                </div>

                <div class="g-data ps-3"><a href="/leaveapproval">
                        <div class="bio  rounded-30  piechart-leads dash-6">
                            <div class="svg-d">
                                <img src="/img/approved.png" />
                            </div>
                            <h3 class="text-center">Leave Approved</h3>
                            <h4>{{$leaveapproved}}</h4>
                        </div>
                    </a>
                </div>

                <div class="g-data ps-3"><a href="/sociallogin">
                        <div class="bio  rounded-30  piechart-leads dash-1">
                            <div class="svg-d">

                                <img src="/img/social-login.png" />

                            </div>
                            <h3 class="text-center ">Social Login</h3>
                            <h4>{{$social}}</h4>
                        </div>
                    </a>
                </div>

            </div>


        </div>
    </div>
    <div class=" col-lg-12 col-xl-6 col-md-12 col-sm-12 ">
        <div class="bio  rounded-30  piechart-leads bl">
            <div class="d-flex justify-content-between align-items-center p-0">
                <div class="p-0">
                    <h4 class="ch-2">Lead</h4>
                </div>
                <div class="p-0">
                    <h6>{{$aallead}} Leads</h6>
                </div>

            </div>




            <div id="bar_charts" style="width: 100%; height:250px;min-height:300px" class="p-0"></div>
        </div>


    </div>
    <div class=" col-lg-12 col-xl-6 col-md-12 col-sm-12 ">
        <div class="bio  rounded-30  piechart-leads yl">
            <div class="d-flex justify-content-between align-items-center p-0">
                <div class="p-0">
                    <h4 class="ch-2"><b>Web</b> Enquiry</h4>
                </div>

                <div class="p-0">
                    <h6>{{ now()->format('d M Y') }}</h6>
                </div>

            </div>
            <div id="area_chart_div" style="width: 100%; height:250px;min-height:300px"></div>
        </div>
    </div>



    <div class="col-lg-8 col-sm-12 ">
        <div class="bio  rounded-30  piechart-leads h-auto">
            <div class="panel row m-0" id="firstRow">
                <div class="d-flex justify-content-between align-items-center p-0">
                    <div class="p-0">
                        <h4 class="ch-2">Renewals</h4>
                    </div>
                    <div class="p-0">
                        <!-- <h6>{{$aallead}} Leads</h6> -->
                    </div>

                </div>
                <div class="rate-d py-1 p-0 my-2">
                </div>
                <!-- <div class="add-newproduct-tab">
                <div class="gradient-card-header">
                    <h2 class="white-text mx-3">Leads</h2>
                </div>
            </div> comment by vasanth-->




                <div class="alert alert-success alert-dismissible px-3 bold" id="session_message" style="display: none;">
                </div>



                <div class="pt-4 table-responsive p-0">
                    <table id="example" class="dataTable mt-6 table table-bordered ">
                        <thead>
                            <tr class="bg-white">
                                <th class="text-grey">S.no</th>
                                <th class="text-grey">Account Name</th>
                                <th class="text-grey">Domain Name</th>
                                <th class="text-grey">Next Renewal Date</th>
                                <th class="text-grey">Day</th>
                                <th class="text-grey">Remaining Days</th>
                                <!-- Add more columns as needed -->
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>




            <div class="modal fade show sp_edit in" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" id="account_type_modal">
                <div class="bind_customer"></div>
            </div>
            <div class="modal fade customer_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
            </div>
        </div>
    </div>

    <div class="col-lg-4 h-auto">
        <div class="bio  rounded-30  piechart-leads h-auto">
            <div class="p-0">
                <h4 class="ch-2">Ratecards</h4>
            </div>
            <div class="rate-d py-3 p-0 my-3">
                <div class="d-flex gap-2 p-0 my-2">
                    <a href="pdf/ratecard/download/organic_seo.pdf" target="_blank" class="rate-link w-100">
                        <div class="d-flex justify-content-between p-0 w-100">
                            <p class="p-0 m-0">Proposal - Organic SEO</p>

                            <svg xmlns="http://www.w3.org/2000/svg" width="25px" height="25px" viewBox="0 0 24 24">
                                <g fill="none" stroke="#666666" stroke-width="0.9">
                                    <circle cx="12" cy="12" r="3" />
                                    <path d="M20.188 10.934c.388.472.582.707.582 1.066s-.194.594-.582 1.066C18.768 14.79 15.636 18 12 18s-6.768-3.21-8.188-4.934c-.388-.472-.582-.707-.582-1.066s.194-.594.582-1.066C5.232 9.21 8.364 6 12 6s6.768 3.21 8.188 4.934Z" />
                                </g>
                            </svg>

                        </div>
                    </a>
                </div>
                <div class="d-flex gap-2 p-0 my-2">
                    <a href="pdf/ratecard/download/digital_marketing_new1.pdf" target="_blank" class="rate-link w-100">
                        <div class="d-flex justify-content-between p-0 w-100">
                            <p class="p-0 m-0">Proposal - Digital Marketing 6 Months</p>

                            <svg xmlns="http://www.w3.org/2000/svg" width="25px" height="25px" viewBox="0 0 24 24">
                                <g fill="none" stroke="#666666" stroke-width="0.9">
                                    <circle cx="12" cy="12" r="3" />
                                    <path d="M20.188 10.934c.388.472.582.707.582 1.066s-.194.594-.582 1.066C18.768 14.79 15.636 18 12 18s-6.768-3.21-8.188-4.934c-.388-.472-.582-.707-.582-1.066s.194-.594.582-1.066C5.232 9.21 8.364 6 12 6s6.768 3.21 8.188 4.934Z" />
                                </g>
                            </svg>

                        </div>
                    </a>
                </div>
                <div class="d-flex gap-2 p-0 my-2">
                    <a href="pdf/ratecard/download/digital_marketing_new2.pdf" target="_blank" class="rate-link w-100">
                        <div class="d-flex justify-content-between p-0 w-100">
                            <p class="p-0  m-0">Proposal - Digital Marketing 1 Year</p>

                            <svg xmlns="http://www.w3.org/2000/svg" width="25px" height="25px" viewBox="0 0 24 24">
                                <g fill="none" stroke="#666666" stroke-width="0.9">
                                    <circle cx="12" cy="12" r="3" />
                                    <path d="M20.188 10.934c.388.472.582.707.582 1.066s-.194.594-.582 1.066C18.768 14.79 15.636 18 12 18s-6.768-3.21-8.188-4.934c-.388-.472-.582-.707-.582-1.066s.194-.594.582-1.066C5.232 9.21 8.364 6 12 6s6.768 3.21 8.188 4.934Z" />
                                </g>
                            </svg>

                        </div>
                    </a>
                </div>
                <div class="d-flex gap-2 p-0 my-2">
                    <a href="pdf/ratecard/download/Website-design-new3.pdf" target="_blank" class="rate-link w-100">
                        <div class="d-flex justify-content-between p-0 w-100">
                            <p class="p-0  m-0">Proposal - Website Premium</p>

                            <svg xmlns="http://www.w3.org/2000/svg" width="25px" height="25px" viewBox="0 0 24 24">
                                <g fill="none" stroke="#666666" stroke-width="0.9">
                                    <circle cx="12" cy="12" r="3" />
                                    <path d="M20.188 10.934c.388.472.582.707.582 1.066s-.194.594-.582 1.066C18.768 14.79 15.636 18 12 18s-6.768-3.21-8.188-4.934c-.388-.472-.582-.707-.582-1.066s.194-.594.582-1.066C5.232 9.21 8.364 6 12 6s6.768 3.21 8.188 4.934Z" />
                                </g>
                            </svg>

                        </div>
                    </a>
                </div>
                <div class="d-flex gap-2 p-0 my-2">
                    <a href="pdf/ratecard/download/Website-design-new4.pdf" target="_blank" class="rate-link w-100">
                        <div class="d-flex justify-content-between p-0 w-100">
                            <p class="p-0  m-0">Proposal - Website Regular</p>

                            <svg xmlns="http://www.w3.org/2000/svg" width="25px" height="25px" viewBox="0 0 24 24">
                                <g fill="none" stroke="#666666" stroke-width="0.9">
                                    <circle cx="12" cy="12" r="3" />
                                    <path d="M20.188 10.934c.388.472.582.707.582 1.066s-.194.594-.582 1.066C18.768 14.79 15.636 18 12 18s-6.768-3.21-8.188-4.934c-.388-.472-.582-.707-.582-1.066s.194-.594.582-1.066C5.232 9.21 8.364 6 12 6s6.768 3.21 8.188 4.934Z" />
                                </g>
                            </svg>

                        </div>
                    </a>
                </div>
                <div class="d-flex gap-2 p-0 my-2">
                    <a href="pdf/ratecard/download/branding-proposal.pdf" target="_blank" class="rate-link w-100">
                        <div class="d-flex justify-content-between p-0 w-100">
                            <p class="p-0  m-0">Proposal - Graphic</p>

                            <svg xmlns="http://www.w3.org/2000/svg" width="25px" height="25px" viewBox="0 0 24 24">
                                <g fill="none" stroke="#666666" stroke-width="0.9">
                                    <circle cx="12" cy="12" r="3" />
                                    <path d="M20.188 10.934c.388.472.582.707.582 1.066s-.194.594-.582 1.066C18.768 14.79 15.636 18 12 18s-6.768-3.21-8.188-4.934c-.388-.472-.582-.707-.582-1.066s.194-.594.582-1.066C5.232 9.21 8.364 6 12 6s6.768 3.21 8.188 4.934Z" />
                                </g>
                            </svg>

                        </div>
                    </a>
                </div>
                <div class="d-flex gap-2 p-0 my-2">
                    <a href="pdf/ratecard/download/proposal.pdf" target="_blank" class="rate-link w-100">
                        <div class="d-flex justify-content-between p-0 w-100">
                            <p class="p-0  m-0">Proposal - Branding</p>

                            <svg xmlns="http://www.w3.org/2000/svg" width="25px" height="25px" viewBox="0 0 24 24">
                                <g fill="none" stroke="#666666" stroke-width="0.9">
                                    <circle cx="12" cy="12" r="3" />
                                    <path d="M20.188 10.934c.388.472.582.707.582 1.066s-.194.594-.582 1.066C18.768 14.79 15.636 18 12 18s-6.768-3.21-8.188-4.934c-.388-.472-.582-.707-.582-1.066s.194-.594.582-1.066C5.232 9.21 8.364 6 12 6s6.768 3.21 8.188 4.934Z" />
                                </g>
                            </svg>

                        </div>
                    </a>
                </div>
                <div class="d-flex gap-2 p-0 my-2">
                    <a href="pdf/ratecard/download/Appac Web Best Practices & Process Flow.pdf" target="_blank" class="rate-link w-100">
                        <div class="d-flex justify-content-between p-0 w-100">
                            <p class="p-0  m-0">Proposal - Appac Best Pratices</p>

                            <svg xmlns="http://www.w3.org/2000/svg" width="25px" height="25px" viewBox="0 0 24 24">
                                <g fill="none" stroke="#666666" stroke-width="0.9">
                                    <circle cx="12" cy="12" r="3" />
                                    <path d="M20.188 10.934c.388.472.582.707.582 1.066s-.194.594-.582 1.066C18.768 14.79 15.636 18 12 18s-6.768-3.21-8.188-4.934c-.388-.472-.582-.707-.582-1.066s.194-.594.582-1.066C5.232 9.21 8.364 6 12 6s6.768 3.21 8.188 4.934Z" />
                                </g>
                            </svg>
                        </div>
                    </a>
                </div>

                <!-- <button class="my-3 rate-btn">See All</button> -->

            </div>

        </div>
    </div>

    <div class="modal fade" id="errorModal" role="dialog" style="">
        <div class="modal-dialog cascading-modal float-end me-3" role="document">
            <!--Content-->
            <div class="modal-content">
                <!--Header-->

                <button type="button" class="close waves-effect waves-light fs-4" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="title ps-3 pt-1">Errors</h4>
                <!--Body-->
                <div class="error-modal px-2 pb-1">

                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>
</div>


@endsection


@section('script')

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    // Load Google Charts
    google.charts.load('current', {
        packages: ['corechart']
    });
    google.charts.setOnLoadCallback(drawAreaChart); // Call the Area Chart function on load

    // Data from Laravel
    const enqCount = @json($wipenqs); // Example: [{ month: "Jan", leads: 120 }, { month: "Feb", leads: 150 }]

    // Process the data
    const enqCounts = enqCount
        .reverse() // Reverse the data order
        .map(({
            month,
            leads
        }) => ({
            month: month.split(' ')[0], // Extract only the month (e.g., "Nov" from "Nov 2024")
            leads: leads,
        }));

    // Calculate the dynamic maximum value
    const maxLeads = Math.max(...enqCounts.map(({
        leads
    }) => leads));
    const dynamicMaxValue = maxLeads <= 2 ? 3 : Math.ceil(maxLeads * 1.2); // Add a buffer of 20% above the maximum

    // Function to draw the Area Chart
    function drawAreaChart() {
        // Prepare data for Google Charts
        const data = google.visualization.arrayToDataTable([
            ['Month', 'Leads', {
                role: 'tooltip',
                p: {
                    html: true
                }
            }],
            ...enqCounts.map(({
                month,
                leads
            }) => [
                month,
                leads,
                customTooltip(month, leads), // Tooltip content
            ])
        ]);

        // Options for the Area Chart
        const options = {
            hAxis: {
                textStyle: {
                    color: '#999'
                },
                gridlines: {
                    color: 'transparent'
                },
            },
            vAxis: {
                minValue: 0,
                maxValue: dynamicMaxValue, // Use the dynamic max value
                textStyle: {
                    color: '#666'
                },
                gridlines: {
                    color: '#eaeaea'
                },
            },
            colors: ['#ffcc80'], // Chart color
            areaOpacity: 0.2,
            lineWidth: 3,
            curveType: 'function',
            backgroundColor: {
                fill: 'transparent'
            },
            legend: 'none', // Disable legend
            tooltip: {
                isHtml: true
            }, // Enable HTML tooltips
            animation: {
                startup: true,
                duration: 1000,
                easing: 'out'
            },
            chartArea: {
                width: '80%',
                height: '80%'
            }, // Adjust chart area
        };

        // Draw the Area Chart
        const chart = new google.visualization.AreaChart(document.getElementById('area_chart_div'));
        chart.draw(data, options);
    }

    // Function to generate a custom tooltip
    function customTooltip(label, value) {
        return `
        <div style="padding: 8px 0px !important;width:100%; color: #fff; background-color: #282b32; border-radius: 5px;">
        <div style="padding: 8px 10px !important;width:80px;">
            <strong  >${month}</strong><br>
            <span style="color: #5884c1;">●</span> ${leads} No's
        </div>
        </div>`;
    }
</script>

<script>
    const months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    google.charts.load('current', {
        packages: ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        // Get last 7 months' lead data from the backend
        var leadCount = @json($leadCounts); // Data from PHP

        const leadCounts = leadCount
            .reverse() // Reverse the data order
            .map(({
                month,
                leads
            }) => ({
                month: month.split(' ')[0], // Extract only the month (e.g., "Nov" from "Nov 2024")
                leads: leads,
            }));

        // Prepare data for Google Charts
        const data = google.visualization.arrayToDataTable([
            ['Month', 'Leads', {
                role: 'style'
            }, {
                role: 'tooltip',
                p: {
                    html: true
                }
            }],
            ...leadCounts.map(({
                month,
                leads
            }) => [
                month,
                leads,
                '#d9e1ef',
                customTooltip(month, leads)
            ])
        ]);

        const options = {
            hAxis: {
                textStyle: {
                    color: '#666',
                    fontSize: 12
                }
            },
            vAxis: {
                minValue: 0,
                gridlines: {
                    color: '#eaeaea'
                },
                textStyle: {
                    color: '#666'
                }
            },
            legend: 'none',
            chartArea: {
                width: '80%',
                height: '70%'
            },
            tooltip: {
                isHtml: true
            },
            animation: {
                startup: true,
                duration: 1000,
                easing: 'out'
            },
            chartArea: {
                width: '80%',
                height: '80%',
            },
        };

        const chart = new google.visualization.ColumnChart(document.getElementById('bar_charts'));
        chart.draw(data, options);
    }

    function customTooltip(month, leads) {
        return `
        <div style="padding: 8px 0px !important;width:100%; color: #fff; background-color: #282b32; border-radius: 5px;">
        <div style="padding: 8px 10px !important;width:80px;">
            <strong  >${month}</strong><br>
            <span style="color: #5884c1;">●</span> ${leads} No's
        </div>
        </div>`;
    }
</script>
<script>
    $(document).ready(function() {

        var cat_table = $('#example').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 3,
            lengthMenu: [3, 10, 20, 50, 100],
            ajax: "{{ action([App\Http\Controllers\Dashboard::class,'index']) }}",
            columns: [{
                    data: 'sno',
                    name: 'sno'
                },

                {
                    data: 'companyname',
                    name: 'companyname'
                },
                {
                    data: 'domainname',
                    name: 'domainname'
                },

                {
                    data: 'dateofexpire',
                    type: 'date-mm-dd', // Use the custom date type
                    orderData: 0
                },
                {
                    data: 'DateFormat',
                    type: 'date-mm-dd', // Use the custom date type
                    orderData: 0
                },

                {
                    data: 'remainday1',
                    name: 'remainday1'
                },



                // Add more columns as needed
            ],
            "drawCallback": function(settings) {
                var api = this.api();
                var pageInfo = api.page.info();
                var start = pageInfo.start;
                api.column(0, {
                    page: 'current'
                }).nodes().each(function(cell, i) {
                    cell.innerHTML = start + i + 1;
                });
            },
            searching: true,
            language: {
                search: '',
                searchPlaceholder: 'Search'
            },
            <?php if (session()->get('role') == 'superadmin') : ?>
                dom: 'lBfrtip', // 'l' for length dropdown, 'B' for buttons
                buttons: [{
                        extend: 'csv',
                        text: 'Export CSV'
                    },
                    {
                        extend: 'excel',
                        text: 'Export Excel'
                    },
                    'colvis' // Column visibility button
                ]
            <?php endif; ?>
        });

        // Add an icon to the search input
        $('.dataTables_filter').addClass('mb-3 position-relative');
        $('.dataTables_filter label').addClass('d-flex align-items-center');
        $('.dataTables_filter input').addClass('form-control ps-5'); // Add padding to the left for the icon
        $('.dataTables_filter').prepend('<i class="fas fa-search position-absolute" style="left: 30px; top: 50%; transform: translateY(-50%); color: #999;"></i>');

        $('.dataTables_filter').addClass('mb-3');
        $('#example_info').addClass('mt-2');
        $('#example_paginate').addClass('mt-3');
        $('.dt-buttons').addClass('ps-2');
        $('#example_wrapper').addClass('overflow-x-auto');


        $(document).on('submit', 'form', function(e) {
            e.preventDefault();

            var form = $(this);
            var container = form.closest('.modal');

            var formData = new FormData(form[0]); // Create a FormData object

            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: formData,
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {

                    $('#session_message').css('display', 'block');
                    $('#session_message').text(response.message);

                    setTimeout(function() {
                        $('#session_message').hide();
                    }, 5000);
                    if (typeof response.reload !== 'undefined') {
                        $('.appac_show').hide();
                        $('.appac_hide').show();

                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                    } else {
                        $('.customer_modal').modal('hide');
                        $('.appac_show').hide();
                        $('.appac_hide').show();
                        cat_table.ajax.reload(null, false); // Prevents table state reset on reload
                    }



                },
                error: function(xhr) {
                    // Handle other types of errors (e.g., server error)

                    var errors = xhr.responseJSON.errors;
                    var errorString = '';

                    for (var key in errors) {
                        errorString += '<span class="text-danger">' + errors[key][0] + '</span><br>';
                    }

                    // Show errors in a Bootstrap modal (assuming you are using Bootstrap)
                    $('#errorModal .error-modal').html(errorString);
                    $('#errorModal').modal('show');
                }
            });
        });


        function Oppourtunity() {

            var id = $('select[name="oppourtunity_status"]').val();
            // alert(id);
            $.ajax({
                url: "{{ action([App\Http\Controllers\Leads::class, 'index']) }}",
                type: 'GET',
                data: {
                    id: id
                },
                success: function(response) {
                    window.location.reload();

                },
                error: function(xhr) {
                    var errors = xhr.responseJSON.errors;
                    var errorString = '';

                    for (var key in errors) {
                        errorString += '<span class="text-danger">' + errors[key][0] + '</span><br>';
                    }

                    $('#errorModal .error-modal').html(errorString);
                    $('#errorModal').modal('show');
                }
            });
        }

        $('select[name="oppourtunity_status"]').on('change', Oppourtunity);

        function Status() {

            var status = $('select[name="lead_status"]').val();

            $.ajax({
                url: "{{ action([App\Http\Controllers\Leads::class, 'index']) }}",
                type: 'GET',
                data: {
                    status: status
                },
                success: function(response) {
                    window.location.reload();

                },
                error: function(xhr) {
                    var errors = xhr.responseJSON.errors;
                    var errorString = '';

                    for (var key in errors) {
                        errorString += '<span class="text-danger">' + errors[key][0] + '</span><br>';
                    }

                    $('#errorModal .error-modal').html(errorString);
                    $('#errorModal').modal('show');
                }
            });
        }

        $('select[name="lead_status"]').on('change', Status);



    });
</script>
@endsection