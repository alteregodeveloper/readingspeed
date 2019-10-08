<div class="row">
    <div class="col">
        <div class="row" id="start-case">
            <div class="col text-center mt-5 mb-5">
                <a href="" class="btn btn-success btn-lg mt-5 mb-5" id="start-test"><i
                        class="fas fa-tachometer-alt"></i>
                    Start test</a>
            </div>
        </div>
        <div class="row justify-content-center hide" id="case-content">
            <div class="col-10">
                <div class="row">
                    <div class="col rounded bg-light p-3">
                        <?= $case->intro ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col text-right border-top mt-3 pt-3">
                        <a href="" class="btn btn-primary" id="conclude-reading"><i class="fas fa-check"></i> Conclude
                            reading</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center hide" id="case-questions">
            <div class="col-10">
                <form action="" class="form">
                    <input type="hidden" name="testid" value="<?= $readingspeedid ?>">
                    <input type="hidden" name="caseid" value="<?= $case->id ?>">
                    <input type="hidden" name="words" value="<?= $case->words ?>">
                    <input type="hidden" name="complexity" value="<?= $case->complexity ?>">
                    <input type="hidden" name="readingtime">
                    <input type="hidden" name="result">
                    <input type="hidden" name="action" value="addresult">
                    <?php echo $qnas; ?>
                    <div class="col text-right">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-check-double"></i> Check</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row justify-content-center hide" id="case-result">
            <div class="col">
                <div class="alert" role="alert"></div>
                <p>Palabras por minuto <strong id="speed"></strong><br />Tiempo <strong id="readingtime"></strong>
                    segundos</p>
                <p class="mt-3">En la siguiente tabla podras observar en <span class="bg-info p-1 rounded">color</span> el nivel de
                    lectura que ha resultado de este test.</p>
                <div class="table-responsive">
                    <table class="table table-bordered text-center">
                        <thead class="thead-light">
                            <tr>
                                <th>&nbsp;</th>
                                <th colspan="6">Primaria</th>
                                <th colspan="3">Secundaria</th>
                                <th colspan="3">Preparatoria</th>
                                <th>Universidad</th>
                            </tr>
                            <tr>
                                <th>Grado escolar</th>
                                <th>1</th>
                                <th>2</th>
                                <th>3</th>
                                <th>4</th>
                                <th>5</th>
                                <th>6</th>
                                <th>1</th>
                                <th>2</th>
                                <th>3</th>
                                <th>1</th>
                                <th>2</th>
                                <th>3</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Usual</td>
                                <td>80</td>
                                <td>115</td>
                                <td>138</td>
                                <td>158</td>
                                <td>173</td>
                                <td>185</td>
                                <td>195</td>
                                <td>204</td>
                                <td>214</td>
                                <td>224</td>
                                <td>237</td>
                                <td>250</td>
                                <td>280</td>
                            </tr>
                            <tr>
                                <td>Adecuado</td>
                                <td>125</td>
                                <td>150</td>
                                <td>180</td>
                                <td>220</td>
                                <td>250</td>
                                <td>270</td>
                                <td>300</td>
                                <td>320</td>
                                <td>350</td>
                                <td>380</td>
                                <td>420</td>
                                <td>450</td>
                                <td>480</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>