# 📋 VisitPathAnalyze

一个分析访问路径日志的程序

## 📐 Tools

使用 `php analyze.php run <program> [<argv>]` 来运行一些工具。

- `all2one` - 将 `logs` 下所有日志汇总到一个文件中。
- `groupby` - 将输入文件按照按指定键名分组保存。

## 📦 DIR

```
VisitPathAnalyze
 ├─ app/    # 工具集目录
 ├─ config/ # 配置文件目录
 ├─ logs/   # 原始日志目录
 ├─ public/ # 可视化结果目录
 ├─ source/ # 处理结果目录
 └─ analyze.php
```