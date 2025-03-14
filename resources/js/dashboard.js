// import EditorJS from '@editorjs/editorjs';
// import Header from '@editorjs/header';
// import List from "@editorjs/list";
// import Table from '@editorjs/table';
// import ImageTool from '@editorjs/image';
// import AttachesTool from '@editorjs/attaches';


// Common
const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// Функция отключения скролла у input type=number
function disableScrollInputNumber() {

  let numberInputs = document.querySelectorAll('.input-number');

  numberInputs.forEach((item) => {
    item.onwheel = function(e) {
      e.preventDefault();
    }
  });

  return false;
}

// Отключение скролла у input type=number
disableScrollInputNumber();


// Input phone mask
let phoneElements = document.querySelectorAll('.phone-mask');

phoneElements.forEach((item) => {
  let maskOptionsPhone = {
    mask: '+{7} (000) 000 00 00'
  };
  let mask = IMask(item, maskOptionsPhone);
});

// Выбор файла Изображение
let inputMainFile = document.querySelector('#input-main-file'),
    mainFileText = document.querySelector('.main-file-text');

if (inputMainFile) {
  inputMainFile.onchange = function() {
    mainFileText.innerHTML = this.files[0].name;
  }
}


// Editor js
const toEditorJs = document.getElementById('input');
const editorJsElement = document.getElementById('editorjs');

if (editorJsElement) {
  const editor = new EditorJS({

    holder: 'editorjs',

    tools: {
      paragraph: {
        toolbox: {
          title: 'Текст'
        }
      },
      /*
      header: {
        class: Header,
        config: {
          levels: [2, 3, 4],
          defaultLevel: 2
        },
        toolbox: {
          title: 'Заголовок'
        }
      },
      */
      list: List,
      table: Table,
      /*
      image: {
        class: ImageTool,
        config: {
          endpoints: {
            byFile: '/ajax/editor-js-upload-image', // Your backend file uploader endpoint
            byUrl: '/ajax/editor-js-upload-image', // Your endpoint that provides uploading by Url
          },
          additionalRequestHeaders: {
            'X-CSRF-TOKEN': token
          }
        },
        toolbox: {
          title: 'Изображение'
        }
      },
      attaches: {
        class: AttachesTool,
        config: {
          endpoint: '/ajax/editor-js-upload-file', // Your backend file uploader endpoint
          additionalRequestHeaders: {
            'X-CSRF-TOKEN': token
          }
        },
        toolbox: {
          title: 'Документ'
        }
      }
      */
    },
    data: toEditorJs ? JSON.parse(toEditorJs.innerText) : '',
    /**
     * Документация
     * https://github.com/codex-team/editor.js/blob/next/example/example-i18n.html
     */
    i18n: {
      /**
       * @type {I18nDictionary}
       */
      messages: {
        "ui": {
          "blockTunes": {
            "toggler": {
              "Click to tune": "Нажмите, чтобы настроить",
              "or drag to move": "или перетащите"
            },
          },
          "inlineToolbar": {
            "converter": {
              "Convert to": "Конвертировать в"
            }
          },
          "toolbar": {
            "toolbox": {
              "Add": "Добавить",
            }
          },
          "popover": {
            "Filter": "Поиск",
            "Nothing found": "Ничего не найдено"
          }
        },
        "toolNames": {
          "Text": "Параграф",
          "Heading": "Заголовок",
          "List": "Список",
          "Warning": "Примечание",
          "Checklist": "Чеклист",
          "Quote": "Цитата",
          "Code": "Код",
          "Delimiter": "Разделитель",
          "Raw HTML": "HTML-фрагмент",
          "Table": "Таблица",
          "Link": "Ссылка",
          "Marker": "Маркер",
          "Bold": "Полужирный",
          "Italic": "Курсив",
          "InlineCode": "Моноширинный",
          "Image": "Картинка"
        },
        "tools": {
          "warning": {
            "Title": "Название",
            "Message": "Сообщение",
          },
          "link": {
            "Add a link": "Вставьте ссылку"
          },
          "stub": {
            'The block can not be displayed correctly.': 'Блок не может быть отображен'
          },
          "image": {
            "Caption": "Подпись",
            "Select an Image": "Выберите файл",
            "With border": "Добавить рамку",
            "Stretch image": "Растянуть",
            "With background": "Добавить подложку",
          },
          "code": {
            "Enter a code": "Код",
          },
          "linkTool": {
            "Link": "Ссылка",
            "Couldn't fetch the link data": "Не удалось получить данные",
            "Couldn't get this link data, try the other one": "Не удалось получить данные по ссылке, попробуйте другую",
            "Wrong response format from the server": "Неполадки на сервере",
          },
          "header": {
            "Header": "Заголовок",
          },
          "paragraph": {
            "Enter something": "Введите текст"
          },
          "list": {
            "Ordered": "Нумерованный",
            "Unordered": "Маркированный",
          },
          "attaches": {
            "Select file to upload": "Выберите файл"
          }
        },
        "blockTunes": {
          "delete": {
            "Delete": "Удалить"
          },
          "moveUp": {
            "Move up": "Переместить вверх"
          },
          "moveDown": {
            "Move down": "Переместить вниз"
          }
        },
      }
    },

  });

  if (toEditorJs) {
    editor.data = JSON.parse(toEditorJs.innerText);
  }

  const saveDataForm = document.getElementById('save-data-form');
  const saveDataBtn = document.getElementById('save-data-btn');
  const saveDataInput = document.getElementById('save-data-input');


  saveDataForm.onsubmit = function(e) {
    // Отменяю отправку формы
    e.preventDefault();

    // Сохраняю данные из editor js
    editor.save()
    .then((savedData) => {
      // Присваиваю saveDataInput.value значение savedData в виде строки
      saveDataInput.value = JSON.stringify(savedData);

      // Если данные есть, то отправляю форму
      if (savedData.blocks.length > 0) {
        saveDataForm.submit();
      }
    })
    .catch((error) => {
      console.error('Saving error', error);
    });

  }
}


// Translate route to confirmDeleteModal
const confirmDeleteModal = document.getElementById('confirmDeleteModal');

if (confirmDeleteModal) {
  const cancelBtn = document.getElementById('cancel-btn');
  const delBtn = document.querySelectorAll('.del-btn');
  const deleteForm = document.getElementById('delete-form');

  delBtn.forEach((item) => {
    item.addEventListener('click', () => {
      deleteForm.action = item.dataset.route;
      confirmDeleteModal.onfocus = function() {
        cancelBtn.focus();
      }
    });
  });
}