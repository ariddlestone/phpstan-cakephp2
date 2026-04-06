# Available Extensions

## MVC Extensions

PHPStan extensions are available for several MVC classes in CakePHP to help PHPStan understand the otherwise
undocumented methods and properties of these classes. The links covered are shown in the diagram below.

```mermaid
classDiagram
    namespace CakePHP {
        class Shell {
            <<abstract>>
            string[] tasks
            string[] uses
        }
        class Model {
            <<abstract>>
            string[] actsAs
            array hasOne
            array hasMany
            array belongsTo
            array hasAndBelongsToMany
            array findMethods
            array mapMethods
        }
        class Behavior {
            <<abstract>>
        }
        class Controller {
            <<abstract>>
            string[] components
            string[] helpers
            string[] uses
        }
        class Component {
            <<abstract>>
            string[] components
        }
        class Helper {
            <<abstract>>
            string[] helpers
        }
    }
    namespace App {
        class AppShell {
            <<abstract>>
        }
        class AppModel {
            <<abstract>>
        }
        class AppController {
            <<abstract>>
        }
        class AppHelper {
            <<abstract>>
        }
    }
    AppShell --|> Shell
    Shell --> "*" Shell
    Shell --> "*" Model
    
    AppModel --|> Model
    Model --> "*" Behavior
    
    AppController --|> Controller
    Controller --> "*" Model
    Controller --> "*" Component
    Controller --> "*" Helper
    Component --> "*" Component
    
    AppHelper --|> Helper
    Helper --> "*" Helper
```
