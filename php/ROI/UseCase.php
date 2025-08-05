<div class="container py-4  smaller-size calculator-wrapper" data-type="usecase">
    <div class="row roi-calculator-box">
        <!-- LEFT PANEL -->
        <div class="col-md-8 left left-panel  smaller-size">
            <div class="tabs-wrapper smaller-size">

                <h2 class="fw-bold text-info mb-4 calculator-tab" data-target="roi">ROI Calculator</h2>
                <h2 class="text-uppercase text-secondary calculator-tab" data-target="usecase">Use Case Builder</h2>
            </div>
            <div class="row two-questions">
                <div class="col-md-6 question spacing single-question">
                    <label for="param1" class="form-label label smaller-size">Work time per employee per day (hrs)</label>
                    <input type="number" value="5" id="param1" class="input form-control" />
                    <p class="error-line text-danger" id="errorLineText1">Please enter a value greater than 0</p>
                </div>

                <div class="col-md-6 question single-question">
                    <label for="param2" class="form-label label smaller-size">Number of people involved</label>
                    <input type="number" value="2" id="param2" class="input form-control" />
                    <p class="error-line text-danger" id="errorLineText2">Please enter a value greater than 0</p>
                </div>
            </div>

            <div class="range-wrap range-wrap1">
                <label class="label smaller-size">Number of steps in the process</label>
                <!--         <output class="bubble1 bubble">1</output> -->
                <input type="range" class="range1 range form-range" id="param4" min="1" max="80" value="1" />
                <div class="range-markers">
                    <span>1</span><span>10</span><span>20</span><span>30</span><span>40</span><span>50</span><span>60</span><span>70</span><span>80</span>
                </div>
            </div>

            <div class="range-wrap range-wrap2">
                <label class="label smaller-size">Number of applications involved</label>
                <!--         <output class="bubble2 bubble">1</output> -->
                <input type="range" class="range2 range form-range" id="param5" min="1" max="8" value="1" />
                <div class="range-markers">
                    <span>1</span><span>2</span><span>3</span><span>4</span><span>5</span><span>6</span><span>7</span><span>8</span>
                </div>

            </div>

            <div class="range-wrap range-wrap3">
                <label class="label smaller-size">How complex is the process?</label>
                <output class="bubble3 bubble">1</output>
                <input type="range" class="range3 range form-range" id="param6" min="1" max="4" value="1" />
                <div class="range-markers">
                    <span>Simple</span><span>Average</span><span>Intermediate</span><span>Complex</span>
                </div>

            </div>

            <?php
            $questions = [
                'Does this process require cognitive skills?' => 'btn1',
                'Is documentation required?' => 'btn2',
                'Is RPA support required post Go-Live?' => 'btn3',
                'Is the input data unstructured?' => 'btn4'
            ];
            foreach ($questions as $text => $id): ?>
                <div class="mb-3 yes-no-box">
                    <label class="question-btn form-label smaller-size">
                        <?= $text ?>
                    </label>
                    <div class="btn-group" role="group">
                        <button type="button" id="<?= $id ?>-yes"
                            class="roi-btn-yes btn btn-outline-info btn-sm me-2 active custom-button" value="1">Yes</button>
                        <button type="button" id="<?= $id ?>-no"
                            class="roi-btn-no btn btn-outline-light btn-sm custom-button" value="0">No</button>
                    </div>
                </div>
            <?php endforeach; ?>



            <div class="mb-3">
                <label class="form-label question-btn question-chk smaller-size">What all parameters does the process
                    include?</label>
                <div class="row multiselect-options-box">
                    <?php
                    $checkboxes = [
                        'Data tables' => 'chk1',
                        'OCR' => 'chk2',
                        'QR Codes' => 'chk3',
                        'Rule-based Processing' => 'chk4',
                        'Bar Codes' => 'chk5',
                        'NLP' => 'chk6',
                        'Complex Algorithm' => 'chk7',
                        'Graphs' => 'chk8'
                    ];
                    foreach ($checkboxes as $label => $id): ?>
                        <div class="col-6 col-md-4 mb-2 option-item">
                            <div class="form-check col-6 col-md-3">
                                <input class="roi-chkbox form-check-input" type="checkbox" id="<?= $id ?>" value="1">
                                <label class="question-checkbox form-check-label text-white smaller-size" for="<?= $id ?>">
                                    <?= $label ?>
                                </label>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- RIGHT PANEL -->
        <div class="col-md-4 right right-panel">
            <h2 class="title1 medium-size text-primary">YOUR USE CASE</h2>
            <div class="mb-3 years-dropdown-box">
                <p class="font1">With ADROSONIC RPA</p>
                <span class="year">in</span>
                <select id="years" class="form-select small-size font-bolder mb-3">
                    <option value="1">1 year</option>
                    <option value="2">2 years</option>
                    <option value="3">3 years</option>
                </select>
            </div>


            <div class="output-section option-item">
                <div class="svg-graphic">
                    <svg xmlns="http://www.w3.org/2000/svg" width="183" height="165" viewBox="0 0 183 165" fill="none">
                        <path
                            d="M97.9462 38.7581C118.449 57.7257 140.018 77.215 140.018 101.415C140.018 135.031 112.695 143.036 78.9932 143.036C45.2915 143.036 17.9688 135.036 17.9688 101.415C17.9688 77.4131 39.3048 58.3393 59.5365 39.2316L48.1105 12.4374C48.0136 12.2151 48.1783 11.9688 48.4205 11.9688H109.556C109.803 11.9688 109.963 12.22 109.861 12.4422L97.9414 38.7581H97.9462Z"
                            stroke="#1A2C47" stroke-width="3" stroke-miterlimit="10" stroke-linecap="round" />
                        <path
                            d="M65.9584 104.782C67.8668 109.058 72.9816 112.116 78.9925 112.116C86.6309 112.116 92.8259 107.174 92.8259 101.081C92.8259 87.0416 65.1641 95.0857 65.1641 81.2924C65.1641 75.2002 71.359 70.2578 78.9974 70.2578C84.5336 70.2578 89.3046 72.8522 91.5181 76.5964"
                            stroke="#1A2C47" stroke-width="3" stroke-miterlimit="10" stroke-linecap="round" />
                        <path d="M78.9922 70.2617V59.7344" stroke="#1A2C47" stroke-width="3" stroke-miterlimit="10"
                            stroke-linecap="round" />
                        <path d="M78.9922 122.509V112.75" stroke="#1A2C47" stroke-width="3" stroke-miterlimit="10"
                            stroke-linecap="round" />
                        <path d="M59.5371 39.2344H97.9468" stroke="#1A2C47" stroke-width="3" stroke-miterlimit="10"
                            stroke-linecap="round" />
                        <path d="M86.123 29.9701L90.2449 11.9688" stroke="#1A2C47" stroke-width="3"
                            stroke-miterlimit="10" stroke-linecap="round" />
                        <path
                            d="M121 104V108C121 110.761 123.239 113 126 113H172C174.761 113 177 110.761 177 108V104C177 101.239 174.761 99 172 99H126C123.239 99 121 101.239 121 104Z"
                            fill="#2D79A6" stroke="#1A2C47" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path
                            d="M122 119V123C122 125.761 124.239 128 127 128H173C175.761 128 178 125.761 178 123V119C178 116.239 175.761 114 173 114H127C124.239 114 122 116.239 122 119Z"
                            fill="#2D79A6" stroke="#1A2C47" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path
                            d="M122 134V138C122 140.761 124.239 143 127 143H173C175.761 143 178 140.761 178 138V134C178 131.239 175.761 129 173 129H127C124.239 129 122 131.239 122 134Z"
                            fill="#2D79A6" stroke="#1A2C47" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
                <p class="font">Your current project time of</p>
                <input class="answer" type="text" id="original-time" disabled />
            </div>

            <div class="output-section option-item">
                <p class="font">will be reduced to</p>
                <input class="answer small-size" type="text" id="optimised-time" disabled />
            </div>

            <div class="output-section option-item">
                <div class="svg-graphic">
                    <svg xmlns="http://www.w3.org/2000/svg" width="144" height="144" viewBox="0 0 144 144" fill="none">
                        <g clip-path="url(#clip0_14487_3746)">
                            <path d="M119.25 128.25H132.75V49.5H119.25L119.25 128.25Z" fill="#2D79A6" stroke="#333333"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M92.25 128.25H105.75V74.25H92.25V128.25Z" fill="#2D79A6" stroke="#333333"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M65.25 128.25H78.75V90H65.25V128.25Z" fill="#2D79A6" stroke="#333333"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M38.25 128.25H51.75L51.75 99H38.25V128.25Z" fill="#2D79A6" stroke="#333333"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M11.25 128.25H24.75L24.75 103.5H11.25L11.25 128.25Z" fill="#2D79A6"
                                stroke="#333333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M71.7053 75.8497C83.7492 70.0064 94.0073 61.7043 101.52 51.7442L106.769 55.7173C107.141 55.9987 107.585 56.1681 108.05 56.2058C108.515 56.2435 108.981 56.1479 109.393 55.9302C109.805 55.7124 110.147 55.3816 110.378 54.9765C110.608 54.5714 110.719 54.1089 110.696 53.6432L109.391 27.0126C109.373 26.6415 109.271 26.2794 109.092 25.9537C108.913 25.628 108.662 25.3472 108.359 25.1325C108.056 24.9179 107.708 24.7749 107.341 24.7145C106.974 24.6542 106.599 24.6779 106.243 24.784L81.9426 32.0333C81.5085 32.1628 81.1188 32.41 80.8167 32.7475C80.5146 33.0851 80.312 33.4998 80.2313 33.9455C80.1507 34.3912 80.1951 34.8506 80.3597 35.2726C80.5244 35.6946 80.8027 36.0628 81.1639 36.3361L86.6917 40.5204C78.7171 51.0661 64.9982 62.4463 53.1886 68.1759C40.5103 74.3269 28.04 76.9035 15.0652 76.0531C14.4741 76.0145 13.889 76.1913 13.4182 76.5508C12.9474 76.9102 12.6226 77.4281 12.5041 78.0084C12.3856 78.5888 12.4813 79.1925 12.7735 79.7078C13.0658 80.2231 13.5347 80.6151 14.0937 80.8113C31.5698 86.9426 52.5683 85.1341 71.7053 75.8497Z"
                                fill="#1A2C47" />
                        </g>
                        <defs>
                            <clipPath id="clip0_14487_3746">
                                <rect width="144" height="144" fill="white" />
                            </clipPath>
                        </defs>
                    </svg>
                </div>
                <p class="font">Your man-hours will be saved up to</p>
                <input class="answer small-size" type="text" id="reduced-hours" disabled />
            </div>

            <div>
                <h3 class="font small-size font-bolder">And a lot more benefits:</h3>
                <ul class="list-group benefits ps-3">
                    <li class="list-group-item">Increased quality of services</li>
                    <li class="list-group-item">Quick turnaround time</li>
                    <li class="list-group-item">Improved business efficiency</li>
                    <li class="list-group-item">Insights and analytics of current business processes</li>
                </ul>
            </div>


            <p class="font medium-size font-bold">Interested to know how?<br />Book a free demo with us today!</p>
            <a href="/contact-us" class="get-in-touch"><button class="custom-button bottom-button">GET IN
                    TOUCH</button></a>
        </div>
    </div>
</div>
<script>
    jQuery(document).ready(function($) {
        let s1 = 1,
            s2 = 1,
            s3 = 1;
        let b1 = 1,
            b2 = 1,
            b3 = 1,
            b4 = 1;
        let yearOption = 1;

        // Initial display values
        $('.bubble1').text(s1);
        $('.bubble2').text(s2);
        $('.bubble3').text(s3);

        // Update slider bubble
        function updateBubble($range, $bubble) {
            const val = $range.val();
            const min = $range.attr('min') || 0;
            const max = $range.attr('max') || 100;
            const newVal = ((val - min) * 100) / (max - min);
            $bubble.text(val);
            $bubble.css('left', `calc(${newVal}% + (${8 - newVal * 0.15}px))`);
        }

        // Slider input handling
        $('.range1').on('input', function() {
            s1 = parseInt(this.value);
            updateBubble($(this), $('.bubble1'));
        });

        $('.range2').on('input', function() {
            s2 = parseInt(this.value);
            updateBubble($(this), $('.bubble2'));
        });

        $('.range3').on('input', function() {
            s3 = parseInt(this.value);
            updateBubble($(this), $('.bubble3'));
        });

        // Just a test calculation update
        function testCalculation() {
            const total = s1 + s2 + s3 + parseInt(b1) + parseInt(b2) + parseInt(b3) + parseInt(b4);
            $('#original-time').val(`${total * 100} Hrs`);
            $('#optimised-time').val(`${total * 60} Hrs`);
            $('#reduced-hours').val(`${total * 40} Hrs`);
        }

        // Button logic
        $('#btn1-yes, #btn1-no').on('click', function() {
            b1 = $(this).val();
            testCalculation();
        });

        $('#btn2-yes, #btn2-no').on('click', function() {
            b2 = $(this).val();
            testCalculation();
        });

        $('#btn3-yes, #btn3-no').on('click', function() {
            b3 = $(this).val();
            testCalculation();
        });

        $('#btn4-yes, #btn4-no').on('click', function() {
            b4 = $(this).val();
            testCalculation();
        });

        $('#years').on('change', function() {
            yearOption = parseInt(this.value);
            testCalculation();
        });

        // Run once at start
        testCalculation();
    });
</script>