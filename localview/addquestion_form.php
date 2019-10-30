<div class="row mt-5">
    <div class="col">
        <div class="row">
            <div class="col">
                <p><?= get_string('category', 'readingspeed') ?> <strong><?= $category ?></strong></p>
            </div>
            <div class="col">
                <p><?= get_string('complexity', 'readingspeed') ?> <strong><?= $complexity ?></strong></p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p><?= get_string('words', 'readingspeed') ?> <strong><?= $words ?></strong></p>
            </div>
        </div>
        <div class="row mt-3 mb-3">
            <div class="col bg-light p-3 rounded"><?= $resume . '...' ?></div>
        </div>
    </div>
    <div class="col">
        <div class="row">
            <div class="col pt-3">
                <form action="" method="POST" class="form" id="newQuestion">
                    <input type="hidden" name="caseid" value="<?= $caseid ?>">
                    <div class="form-group" id="question">
                        <div class="alert hide" role="alert"></div>
                        <label for="question"><?= get_string('question', 'readingspeed') ?></label>
                        <textarea class="form-control" name="question" rows="3"></textarea>
                    </div>
                    <div class="form-group" id="answers">
                        <label for="question"><?= get_string('answers', 'readingspeed') ?></label>
                        <div class="row mb-3">
                            <div class="col-10">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="checkbox" checked
                                                aria-label="Checkbox for following text input">
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" name="answ_1"
                                        aria-label="Text input with checkbox">
                                </div>
                                <small class="form-text text-muted"><?= get_string('checkedisthecorrect', 'readingspeed') ?></small>
                            </div>
                            <div class="col-1">
                                <a href="" class="btn btn-primary addanswer" title="<?= get_string('addnewanswer', 'readingspeed') ?>" data-element="1"><i
                                        class="fas fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col border-top pt-3 text-right">
        <a href="<?= '//' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?id=' . $activity ?>"
            class="btn btn-secondary"><?= get_string('exit', 'readingspeed') ?></a> <a href="" class="btn btn-primary addquestion"><?= get_string('addnewanswer', 'readingspeed') ?><?= get_string('addnewquestion', 'readingspeed') ?></a>
    </div>
</div>

<div class="row mt-3">
    <div class="col border-top pt-3 border-bottom pb-3 mb-3">
        <h4><?= get_string('questions', 'readingspeed') ?></h4>
        <div id="question-container"></div>
    </div>
</div>