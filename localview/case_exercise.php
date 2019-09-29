<div class="row">
    <div class="col">
        <div class="row" id="start-case">
            <div class="col text-center mt-5 mb-5">
                <a href="" class="btn btn-success btn-lg mt-5 mb-5" id="start-test"><i class="fas fa-tachometer-alt"></i>
                    Start test</a>
            </div>
        </div>
        <div class="row justify-content-center hide" id="case-content">
            <div class="col-10">
                <div class="alert" role="alert"></div>
                <div class="row">
                    <div class="col rounded bg-light p-3">
                    <?= $case->intro ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col text-right border-top mt-3 pt-3">
                        <a href="" class="btn btn-primary" id="conclude-reading"><i class="fas fa-check"></i> Conclude reading</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center hide" id="case-questions">
            <div class="col-10">
                <form action="" class="form">
                    <input type="hidden" name="testid" value="<?= $readingspeedid ?>">
                    <input type="hidden" name="caseid" value="<?= $case->id ?>">
                    <input type="hidden" name="speed">
                    <input type="hidden" name="result">
                    <input type="hidden" name="action" value="addresult">
                    <?php echo $qnas; ?>
                    <div class="col text-right">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-check-double"></i> Check</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>