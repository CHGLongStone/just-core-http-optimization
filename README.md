# just-core-http-optimization
http-optimization

loading 6 million css and especialy js files kills your browser resources
lets make all those individual files load in dev so we can debug easily
group the files into a reasonably coherent naming convention and we can 
compile and filter (minify etc.) global and view specific assets.

Assetic supports doing that in a reasonably concise manner

This "plugin" is simply a wrapper for Assetic to be used by the [just-core-stub](https://github.com/CHGLongStone/just-core-stub) project

### Assetic

[kriswallsmith/assetic](https://github.com/kriswallsmith/assetic)
[assetic docs](https://github.com/kriswallsmith/assetic/blob/master/docs/en/index.md)
